<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\CutoffTestDataSeeder;
use App\Models\repurchase_cutoff_slots;
use App\Models\awards_and_rewards_cutoff_slots;
use App\Models\mlm_plan;
use App\Models\plan_activation_queue;
use Illuminate\Support\Facades\DB;

class CutoffDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'cutoff:data 
                            {action : Action to perform (seed|clean|reset|status)}
                            {--force : Force execution without confirmation}';

    /**
     * The console command description.
     */
    protected $description = 'Manage cutoff test data (seed, clean, reset, status)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');
        $force = $this->option('force');

        $this->info('🗃️ Cutoff Data Management');
        $this->info('========================');

        switch ($action) {
            case 'seed':
                $this->seedTestData($force);
                break;
            case 'clean':
                $this->cleanTestData($force);
                break;
            case 'reset':
                $this->resetTestData($force);
                break;
            case 'status':
                $this->showDataStatus();
                break;
            default:
                $this->error('❌ Invalid action. Use: seed, clean, reset, or status');
                return 1;
        }

        return 0;
    }

    /**
     * Seed test data
     */
    private function seedTestData($force)
    {
        $this->info('🌱 Seeding cutoff test data...');

        // Check if test data already exists
        $existingData = $this->checkExistingTestData();
        
        if ($existingData && !$force) {
            $this->warn('⚠️ Test data already exists:');
            foreach ($existingData as $type => $count) {
                if ($count > 0) {
                    $this->warn("   - $type: $count records");
                }
            }
            
            if (!$this->confirm('Continue with seeding? (This may create duplicates)')) {
                $this->info('❌ Cancelled by user');
                return;
            }
        }

        try {
            $seeder = new CutoffTestDataSeeder();
            $seeder->setCommand($this);
            $seeder->run();
            
            $this->info('✅ Test data seeding completed successfully');
            $this->showDataStatus();
            
        } catch (\Exception $e) {
            $this->error('❌ Error seeding test data: ' . $e->getMessage());
        }
    }

    /**
     * Clean test data
     */
    private function cleanTestData($force)
    {
        $this->info('🧹 Cleaning cutoff test data...');

        $existingData = $this->checkExistingTestData();
        $totalRecords = array_sum($existingData);

        if ($totalRecords == 0) {
            $this->info('ℹ️ No test data found to clean');
            return;
        }

        $this->warn("⚠️ This will delete $totalRecords test records:");
        foreach ($existingData as $type => $count) {
            if ($count > 0) {
                $this->warn("   - $type: $count records");
            }
        }

        if (!$force && !$this->confirm('Are you sure you want to delete all test data?')) {
            $this->info('❌ Cancelled by user');
            return;
        }

        try {
            $seeder = new CutoffTestDataSeeder();
            $seeder->setCommand($this);
            $seeder->cleanup();
            
            $this->info('✅ Test data cleaned successfully');
            
        } catch (\Exception $e) {
            $this->error('❌ Error cleaning test data: ' . $e->getMessage());
        }
    }

    /**
     * Reset test data (clean + seed)
     */
    private function resetTestData($force)
    {
        $this->info('🔄 Resetting cutoff test data (clean + seed)...');

        if (!$force && !$this->confirm('This will delete existing test data and create fresh data. Continue?')) {
            $this->info('❌ Cancelled by user');
            return;
        }

        // Clean first
        $this->cleanTestData(true);
        
        // Then seed
        $this->seedTestData(true);
        
        $this->info('✅ Test data reset completed');
    }

    /**
     * Show current data status
     */
    private function showDataStatus()
    {
        $this->info('📊 Current Data Status');
        $this->info('=====================');

        // Test members
        $testMembers = mlm_plan::where('memberid', 'like', 'TEST%')->count();
        $this->info("👥 Test Members: $testMembers");

        // Test repurchases
        $testRepurchases = mlm_plan::where('memberid', 'like', 'RP%')->count();
        $this->info("🔄 Test Repurchases: $testRepurchases");

        // Test activation queue entries
        $testQueue = plan_activation_queue::where('login_id', 'like', 'TEST%')->count();
        $this->info("📋 Test Queue Entries: $testQueue");

        // Test ecom orders
        $testOrders = DB::table('ecom_orders')->where('user_id', 'like', 'TEST%')->count();
        $this->info("🛒 Test Ecom Orders: $testOrders");

        // Test cutoff slots
        $testRepurchaseSlots = repurchase_cutoff_slots::where('name', 'like', 'Test%')->count();
        $testAwardsSlots = awards_and_rewards_cutoff_slots::where('name', 'like', 'Test%')->count();
        $this->info("📅 Test Cutoff Slots: $testRepurchaseSlots repurchase, $testAwardsSlots awards");

        // Pending cutoff slots
        $pendingRepurchase = repurchase_cutoff_slots::where('status', 'pending')->count();
        $pendingAwards = awards_and_rewards_cutoff_slots::where('status', 'pending')->count();
        $this->info("⏳ Pending Slots: $pendingRepurchase repurchase, $pendingAwards awards");

        // Environment status
        $testingMode = env('CUTOFF_TESTING_MODE', false) ? 'Enabled' : 'Disabled';
        $bypassTime = env('CUTOFF_BYPASS_TIME_CHECK', false) ? 'Enabled' : 'Disabled';
        $forceDate = env('CUTOFF_FORCE_DATE', 'None');
        
        $this->info('');
        $this->info('🔧 Environment Status');
        $this->info("   Testing Mode: $testingMode");
        $this->info("   Bypass Time: $bypassTime");
        $this->info("   Force Date: $forceDate");

        // Recent activity
        $this->info('');
        $this->info('📈 Recent Activity (Last 24 hours)');
        
        $recentMembers = mlm_plan::where('created_at', '>=', now()->subDay())->count();
        $recentOrders = DB::table('ecom_orders')->where('created_at', '>=', now()->subDay())->count();
        
        $this->info("   New Members: $recentMembers");
        $this->info("   New Orders: $recentOrders");
    }

    /**
     * Check existing test data
     */
    private function checkExistingTestData()
    {
        return [
            'Test Members' => mlm_plan::where('memberid', 'like', 'TEST%')->count(),
            'Test Repurchases' => mlm_plan::where('memberid', 'like', 'RP%')->count(),
            'Test Queue Entries' => plan_activation_queue::where('login_id', 'like', 'TEST%')->count(),
            'Test Ecom Orders' => DB::table('ecom_orders')->where('user_id', 'like', 'TEST%')->count(),
            'Test Repurchase Slots' => repurchase_cutoff_slots::where('name', 'like', 'Test%')->count(),
            'Test Awards Slots' => awards_and_rewards_cutoff_slots::where('name', 'like', 'Test%')->count(),
        ];
    }
}