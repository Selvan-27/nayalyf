<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\plan_activation_job;
use App\Models\repurchase_cutoff_slots;
use App\Models\awards_and_rewards_cutoff_slots;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CutoffTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'cutoff:test 
                            {type : Type of cutoff (repurchase|awards|both)}
                            {--date= : Specific date to test (YYYY-MM-DD)}
                            {--force : Force execution without confirmation}
                            {--dry-run : Preview what would happen without execution}
                            {--detailed : Show detailed processing information}
                            {--scenario= : Use predefined scenario (immediate|specific_time|specific_date)}';

    /**
     * The console command description.
     */
    protected $description = 'Test cutoff processing with flexible date and time options';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        $date = $this->option('date');
        $force = $this->option('force');
        $dryRun = $this->option('dry-run');
        $detailed = $this->option('detailed');
        $scenario = $this->option('scenario');

        // Display header
        $this->info('🧪 Cutoff Testing Command');
        $this->info('========================');
        
        // Load scenario if specified
        if ($scenario) {
            $this->applyScenario($scenario);
        }

        // Validate inputs
        if (!in_array($type, ['repurchase', 'awards', 'both'])) {
            $this->error('❌ Invalid type. Use: repurchase, awards, or both');
            return 1;
        }

        // Set test date (priority: --date option > CUTOFF_FORCE_DATE env > today)
        $testDate = null;
        if ($date) {
            $testDate = Carbon::parse($date);
        } elseif (env('CUTOFF_FORCE_DATE')) {
            $testDate = Carbon::parse(env('CUTOFF_FORCE_DATE'));
        } else {
            $testDate = now();
        }
        $this->info("📅 Test Date: " . $testDate->format('Y-m-d'));

        // Safety confirmation
        if (!$force && !$dryRun) {
            if (!$this->confirm('⚠️  This will run actual cutoff processing. Continue?')) {
                $this->info('❌ Cancelled by user');
                return 0;
            }
        }

        // Set up testing environment
        $this->setupTestingEnvironment($testDate, $dryRun, $detailed);

        try {
            if ($dryRun) {
                $this->info('🔍 DRY RUN MODE - No actual processing will occur');
                $this->previewCutoffProcessing($type, $testDate);
            } else {
                $this->info('🚀 Starting cutoff processing...');
                $this->runCutoffProcessing($type);
            }

            $this->info('✅ Cutoff testing completed successfully');
            return 0;

        } catch (\Exception $e) {
            $this->error('❌ Error during cutoff testing: ' . $e->getMessage());
            
            if ($detailed) {
                $this->error('Stack trace: ' . $e->getTraceAsString());
            }
            
            return 1;
        } finally {
            $this->cleanupTestingEnvironment();
        }
    }

    /**
     * Apply predefined scenario settings
     */
    private function applyScenario($scenario)
    {
        $scenarios = config('cutoff.scenarios', []);
        
        if (!isset($scenarios[$scenario])) {
            $this->error("❌ Unknown scenario: $scenario");
            $this->info('Available scenarios: ' . implode(', ', array_keys($scenarios)));
            exit(1);
        }

        $settings = $scenarios[$scenario];
        $this->info("🎯 Applying scenario: $scenario - {$settings['description']}");

        // Temporarily set environment variables
        foreach ($settings as $key => $value) {
            if ($key !== 'description') {
                $envKey = 'CUTOFF_' . strtoupper($key);
                putenv("$envKey=$value");
                $this->info("   🔧 $envKey = $value");
            }
        }
    }

    /**
     * Set up testing environment
     */
    private function setupTestingEnvironment($testDate, $dryRun, $detailed)
    {
        // Set testing mode environment variables
        putenv('CUTOFF_TESTING_MODE=true');
        putenv('CUTOFF_BYPASS_TIME_CHECK=true');
        putenv('CUTOFF_FORCE_DATE=' . $testDate->format('Y-m-d'));
        
        if ($detailed) {
            putenv('CUTOFF_TEST_LOG_LEVEL=debug');
        }

        $this->info('🔧 Testing environment configured');
        $this->info("   📅 Force Date: " . $testDate->format('Y-m-d'));
        $this->info("   ⏰ Time Check: Bypassed");
        $this->info("   🧪 Testing Mode: Enabled");
        
        if ($dryRun) {
            $this->info("   👁️  Dry Run: Enabled");
        }
    }

    /**
     * Preview cutoff processing without execution
     */
    private function previewCutoffProcessing($type, $testDate)
    {
        $this->info('🔍 Previewing cutoff processing...');
        
        if (in_array($type, ['repurchase', 'both'])) {
            $this->previewRepurchaseCutoff($testDate);
        }
        
        if (in_array($type, ['awards', 'both'])) {
            $this->previewAwardsCutoff($testDate);
        }
    }

    /**
     * Preview repurchase cutoff
     */
    private function previewRepurchaseCutoff($testDate)
    {
        $this->info('💰 Repurchase Cutoff Preview:');
        
        $cutoffSlot = repurchase_cutoff_slots::where('status', 'pending')
            ->where('from_date', '<=', $testDate->format('Y-m-d'))
            ->orderBy('id', 'asc')
            ->first();

        if ($cutoffSlot) {
            $this->info("   ✅ Found cutoff slot: {$cutoffSlot->name}");
            $this->info("   📅 Period: {$cutoffSlot->from_date} to {$cutoffSlot->to_date}");
            
            // Count regular members
            $memberCount = DB::table('mlm_plan')
                ->join('plan_activation_queue', 'mlm_plan.memberid', '=', 'plan_activation_queue.activation_id')
                ->where('mlm_plan.memberid_type', 'regular')
                ->where('plan_activation_queue.status', 'success')
                ->count();
            
            $this->info("   👥 Regular members to process: $memberCount");
            
            // Count ecom orders in period
            $orderCount = DB::table('ecom_orders')
                ->whereDate('created_at', '>=', $cutoffSlot->from_date)
                ->whereDate('created_at', '<=', $cutoffSlot->to_date)
                ->where('status', 'delivered')
                ->count();
            
            $this->info("   🛒 Ecom orders in period: $orderCount");
            
        } else {
            $this->warn("   ⚠️ No pending repurchase cutoff slot found for date: " . $testDate->format('Y-m-d'));
        }
    }

    /**
     * Preview awards cutoff
     */
    private function previewAwardsCutoff($testDate)
    {
        $this->info('🏆 Awards Cutoff Preview:');
        
        $cutoffSlot = awards_and_rewards_cutoff_slots::where('status', 'pending')
            ->where('from_date', '<=', $testDate->format('Y-m-d'))
            ->where('to_date', '=', $testDate->format('Y-m-d'))
            ->orderBy('id', 'asc')
            ->first();

        if ($cutoffSlot) {
            $this->info("   ✅ Found awards cutoff slot: {$cutoffSlot->name}");
            $this->info("   📅 Period: {$cutoffSlot->from_date} to {$cutoffSlot->to_date}");
            
            // Count active regular members
            $memberCount = DB::table('mlm_plan')
                ->where('memberid_type', 'regular')
                ->where('status', 1)
                ->count();
            
            $this->info("   👥 Active regular members: $memberCount");
            
        } else {
            $this->warn("   ⚠️ No pending awards cutoff slot found for date: " . $testDate->format('Y-m-d'));
        }
    }

    /**
     * Run actual cutoff processing
     */
    private function runCutoffProcessing($type)
    {
        $job = new plan_activation_job();
        
        if (in_array($type, ['repurchase', 'both'])) {
            $this->info('💰 Processing repurchase cutoff...');
            $this->callMethod($job, 'processRepurchaseCutoff');
        }
        
        if (in_array($type, ['awards', 'both'])) {
            $this->info('🏆 Processing awards cutoff...');
            $this->callMethod($job, 'processAwardsAndRewardsCutoff');
        }
    }

    /**
     * Call private method using reflection
     */
    private function callMethod($object, $methodName)
    {
        $reflection = new \ReflectionClass($object);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invoke($object);
    }

    /**
     * Clean up testing environment
     */
    private function cleanupTestingEnvironment()
    {
        // Reset environment variables
        putenv('CUTOFF_TESTING_MODE');
        putenv('CUTOFF_BYPASS_TIME_CHECK');
        putenv('CUTOFF_FORCE_DATE');
        putenv('CUTOFF_TEST_LOG_LEVEL');
        
        $this->info('🧹 Testing environment cleaned up');
    }
}