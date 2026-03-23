<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\plan_activation_job;
use App\Models\plan_activation_queue;

class ManageActivationQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activation:manage {action : Action to perform (stats|reset|clear-failed)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage the plan activation queue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'stats':
                $this->showStats();
                break;
                
            case 'reset':
                $this->resetFailedActivations();
                break;
                
            case 'clear-failed':
                $this->clearFailedActivations();
                break;
                
            default:
                $this->error('Invalid action. Available actions: stats, reset, clear-failed');
                return 1;
        }

        return 0;
    }

    /**
     * Show activation queue statistics
     */
    private function showStats()
    {
        $stats = plan_activation_job::getActivationStats();
        
        $this->info('Plan Activation Queue Statistics:');
        $this->table(
            ['Status', 'Count'],
            [
                ['Pending', $stats['pending']],
                ['Processing', $stats['processing']],
                ['Success', $stats['success']],
                ['Failed', $stats['failed']],
            ]
        );

        $total = array_sum($stats);
        $this->info("Total records: {$total}");

        if ($stats['failed'] > 0) {
            $this->warn("⚠️  There are {$stats['failed']} failed activations that will block future job runs!");
            $this->info("Use 'php artisan activation:manage reset' to reset them to pending.");
        }

        if ($stats['processing'] > 0) {
            $this->warn("⚠️  There are {$stats['processing']} stuck processing activations!");
            $this->info("These may be from interrupted job runs. Use 'php artisan activation:manage reset' to reset them.");
        }
    }

    /**
     * Reset failed activations back to pending
     */
    private function resetFailedActivations()
    {
        $failedCount = plan_activation_queue::where('activation_status', 'failed')->count();
        $processingCount = plan_activation_queue::where('activation_status', 'processing')->count();
        
        if ($failedCount === 0 && $processingCount === 0) {
            $this->info('No failed or processing activations to reset.');
            return;
        }

        if ($this->confirm("This will reset {$failedCount} failed and {$processingCount} processing activations back to pending. Continue?")) {
            
            // Reset failed to pending
            plan_activation_queue::where('activation_status', 'failed')
                ->update(['activation_status' => 'pending']);
                
            // Reset processing to pending (in case they're stuck)
            plan_activation_queue::where('activation_status', 'processing')
                ->update(['activation_status' => 'pending']);

            $totalReset = $failedCount + $processingCount;
            $this->info("✅ Successfully reset {$totalReset} activations back to pending status.");
            $this->info("The activation job can now resume processing.");
        }
    }

    /**
     * Clear failed activations (delete them)
     */
    private function clearFailedActivations()
    {
        $failedCount = plan_activation_queue::where('activation_status', 'failed')->count();
        
        if ($failedCount === 0) {
            $this->info('No failed activations to clear.');
            return;
        }

        if ($this->confirm("This will permanently delete {$failedCount} failed activation records. Continue?")) {
            plan_activation_queue::where('activation_status', 'failed')->delete();
            $this->info("✅ Successfully deleted {$failedCount} failed activation records.");
        }
    }
}
