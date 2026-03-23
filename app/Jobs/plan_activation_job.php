<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

// Include models
use App\Models\plan_activation_queue;
use App\Models\mlm_plan;
use App\Models\team_performance_tree;
use App\Models\global_tree;
use App\Models\achievement_tree;
use App\Models\fast_track_tree;
use App\Models\repurchase_level_income;
use App\Models\achievement_level_income;
use App\Models\repurchase_cutoff_slots;
use App\Models\awards_and_rewards_cutoff_slots;
use App\Models\awarded_members;
use App\Models\rank_progress;
use App\Models\topupdetails;
use App\Models\unique_incentive_income;
use App\Models\leaders_level_income;
use App\Models\leaders_level_tracking;
use App\Models\leaders_matrix_tree;
use App\Models\leaders_matrix_income;

// Include controllers
use App\Http\Controllers\PlanActivationController;
use App\Http\Controllers\tree_traversal_controller;
use App\Http\Controllers\IncomeController;

class plan_activation_job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the appropriate logger based on testing mode
     */
    private function getCutoffLogger()
    {
        $testingMode = env('CUTOFF_TESTING_MODE', false);
        return $testingMode ? 
            Log::channel('cutoff_testing') : 
            Log::channel('cutoff_production');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Plan Activation Job started');

        try {
            // Check if there are any failed or processing records
            if ($this->hasFailedOrProcessingRecords()) {
                Log::info('Found failed or processing records, skipping this run');
                return;
            }

            // Fetch pending activation records
            $pendingActivations = plan_activation_queue::where('activation_status', 'pending')
                ->orderBy('id', 'asc')
                ->limit(10) // Process in batches
                ->get();

            if ($pendingActivations->isEmpty()) {
                Log::info('No pending activations found');
                
                // Check for repurchase ID generation opportunities
                $this->checkAndGenerateRepurchaseIds();
                
                // Continue to cutoff processing (don't return early)
            } else {

            Log::info('Found ' . $pendingActivations->count() . ' pending activations to process');

            $planActivationController = new PlanActivationController();

            // Process records with dynamic priority (children first, then original records)
            $this->processPendingActivationsWithPriority($planActivationController);

            Log::info('Plan Activation Job completed successfully');
            }
            
            // ALWAYS check for cutoff processing regardless of pending activations
            // This runs at the designated time (10:30 AM IST for testing)
            Log::info('🕐 Checking for end-of-day cutoff processing...');
            Log::info('⏰ Current Indian time: ' . now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s T'));
            
            // Check for repurchase level income cutoff processing
            $this->processRepurchaseCutoff();
            
            // Check for awards and rewards cutoff processing
            $this->processAwardsAndRewardsCutoff();

        } catch (\Exception $e) {
            Log::error('Critical error in Plan Activation Job: ' . $e->getMessage());
            
            // Mark any processing records as failed
            plan_activation_queue::where('activation_status', 'processing')
                ->update(['activation_status' => 'failed']);
                
            throw $e; // Re-throw to trigger the failed() method
        }
    }

    /**
     * Add topup entry for regular member activation
     */
    private function addTopupForRegularMember($activation, $mlmPlan)
    {
        try {
            // Only add topup for regular members
            if ($mlmPlan->memberid_type === 'regular') {

                $topup = new topupdetails();
                $topup->loginid = $activation->login_id;
                $topup->memberid = $activation->activation_id;
                $topup->amount = 1600.00;
                $topup->topup_date = now();
                $topup->save();

                Log::info("💰 Added topup entry: ₹1600 for regular member {$activation->activation_id} with login ID {$activation->login_id}");
            } else {
                Log::info("ℹ️ Skipped topup entry for non-regular member {$activation->activation_id} (type: {$mlmPlan->memberid_type})");
            }

        } catch (\Exception $e) {
            Log::error("Error adding topup for member {$activation->activation_id}: " . $e->getMessage());
        }
    }

    /**
     * Process global_tree_rebirth activation - isolated from other systems
     */
    private function processGlobalTreeRebirthActivation($activation, $mlmPlan)
    {
        try {
            Log::info("🌍 Processing isolated global_tree_rebirth activation for: {$activation->activation_id}");

            // Check if already activated
            if ($mlmPlan->status == 1) {
                Log::warning("Global tree rebirth already activated: {$activation->activation_id}");
                return true;
            }

            // Update status to activated
            $mlmPlan->status = 1;
            $mlmPlan->save();

            // Only place in global_tree (isolated processing)
            $planActivationController = new PlanActivationController();
            $success = $planActivationController->placeInTree('global_tree', $activation->activation_id, $mlmPlan->sponsor_id, 1, 'global');

            if ($success) {
                Log::info("✅ Successfully placed global_tree_rebirth {$activation->activation_id} in global tree");
                return true;
            } else {
                Log::error("❌ Failed to place global_tree_rebirth {$activation->activation_id} in global tree");
                // Rollback status
                $mlmPlan->status = 0;
                $mlmPlan->save();
                return false;
            }

        } catch (\Exception $e) {
            Log::error("Error in global_tree_rebirth isolated processing: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Check if there are any failed or processing records
     */
    private function hasFailedOrProcessingRecords()
    {
        $failedCount = plan_activation_queue::where('activation_status', 'failed')->count();
        $processingCount = plan_activation_queue::where('activation_status', 'processing')->count();
        
        if ($failedCount > 0) {
            Log::error("Found {$failedCount} failed activation records. Job execution stopped.");
        }
        
        if ($processingCount > 0) {
            Log::warning("Found {$processingCount} processing activation records. Job execution stopped.");
        }
        
        return ($failedCount > 0 || $processingCount > 0);
    }

    /**
     * Validate if member is ready for activation
     */
    private function validateMemberForActivation($activationId)
    {
        try {
            // Check if member exists in mlm_plan
            $mlmPlan = mlm_plan::where('memberid', $activationId)->first();
            
            if (!$mlmPlan) {
                Log::error('Member not found in mlm_plan: ' . $activationId);
                return false;
            }

            // Check if member is already activated
            if ($mlmPlan->status == 1) {
                Log::warning('Member already activated: ' . $activationId);
                return false;
            }

            // For rebirth members, additional validations can be added here
            if ($mlmPlan->memberid_type === 'rebirth') {
                // Validate rebirth conditions
                return $this->validateRebirthConditions($mlmPlan);
            }

            // For global_tree_rebirth, use simplified validation (no complex checks needed)
            if ($mlmPlan->memberid_type === 'global_tree_rebirth') {
                Log::info("✅ Global tree rebirth validation passed for: $activationId");
                return true;
            }

            return true;

        } catch (\Exception $e) {
            Log::error('Error validating member for activation ' . $activationId . ': ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Validate rebirth conditions
     */
    private function validateRebirthConditions($mlmPlan)
    {
        // Check if original member that generated this rebirth is still qualified
        // Additional rebirth-specific validations can be added here
        return true;
    }

    /**
     * Update sponsor's referral count
     */
    private function updateSponsorReferralCount($activationId)
    {
        try {
            $mlmPlan = mlm_plan::where('memberid', $activationId)->first();
            
            if ($mlmPlan && $mlmPlan->sponsor_id) {
                $sponsor = mlm_plan::where('memberid', $mlmPlan->sponsor_id)->first();
                
                if ($sponsor) {
                    // Count active direct referrals
                    $activeReferrals = mlm_plan::where('sponsor_id', $mlmPlan->sponsor_id)
                        ->where('status', 1)
                        ->count();
                    
                    $sponsor->referral_count = $activeReferrals;
                    $sponsor->save();
                    
                    Log::info('Updated referral count for sponsor ' . $mlmPlan->sponsor_id . ' to ' . $activeReferrals);
                }
            }

        } catch (\Exception $e) {
            Log::error('Error updating sponsor referral count for member ' . $activationId . ': ' . $e->getMessage());
        }
    }

    /**
     * Handle job failure
     */
    public function failed(\Throwable $exception)
    {
        Log::error('Plan Activation Job failed: ' . $exception->getMessage());
        Log::error('Stack trace: ' . $exception->getTraceAsString());
        
        // Reset any processing records back to failed
        plan_activation_queue::where('activation_status', 'processing')
            ->update(['activation_status' => 'failed']);
    }

    /**
     * Method to reset failed activations back to pending (for admin use)
     * This should be called manually when issues are resolved
     */
    public static function resetFailedActivations()
    {
        $failedCount = plan_activation_queue::where('activation_status', 'failed')->count();
        
        if ($failedCount > 0) {
            plan_activation_queue::where('activation_status', 'failed')
                ->update(['activation_status' => 'pending']);
            
            Log::info("Reset {$failedCount} failed activations back to pending status");
            return $failedCount;
        }
        
        return 0;
    }

    /**
     * Get statistics about activation queue status
     */
    public static function getActivationStats()
    {
        return [
            'pending' => plan_activation_queue::where('activation_status', 'pending')->count(),
            'processing' => plan_activation_queue::where('activation_status', 'processing')->count(),
            'success' => plan_activation_queue::where('activation_status', 'success')->count(),
            'failed' => plan_activation_queue::where('activation_status', 'failed')->count(),
        ];
    }

    /**
     * Check and generate repurchase IDs based on PV accumulation
     */
    private function checkAndGenerateRepurchaseIds()
    {
        try {
            Log::info('🛒 Checking for repurchase ID generation opportunities...');

            // Get PV totals grouped by user_id from ecom_orders for active members only
           $pvTotals = \DB::table('ecom_orders')
                    ->join('mlm_plan', 'ecom_orders.user_id', '=', 'mlm_plan.memberid')
                    ->select('ecom_orders.user_id', \DB::raw('SUM(ecom_orders.PV) as total_pv'))
                    // ->where('ecom_orders.created_at', '<=', now()->subHours(5))
                    ->where('ecom_orders.status', '=', 'delivered')
                    ->where('mlm_plan.status', 1) // Only active members
                    ->groupBy('ecom_orders.user_id')
                    ->having('total_pv', '>=', 1600)
                    ->get();

                if ($pvTotals->isEmpty()) {
                    Log::info('No users found with PV >= 1600');
                    return;
                }

                Log::info('Found ' . $pvTotals->count() . ' users with PV >= 1600');

            $planActivationController = new PlanActivationController();

            foreach ($pvTotals as $pvData) {
                
                $userId = $pvData->user_id;
                $totalPv = $pvData->total_pv;


                // Count already generated repurchase IDs for this user
                $existingRepurchaseCount = mlm_plan::where('all_father_id', $userId)
                    ->where('memberid_type', 'repurchase')
                    ->count();

                // Calculate available PV after deducting already used PV
                $usedPv = $existingRepurchaseCount * 1600;
                $availablePv = $totalPv - $usedPv;

                // Calculate how many new repurchase IDs can be generated
                $newRepurchaseCount = floor($availablePv / 1600);

                if ($newRepurchaseCount > 0) {
                    Log::info("🎯 User $userId: Total PV: $totalPv, Used PV: $usedPv, Available PV: $availablePv");
                    Log::info("🆕 Generating $newRepurchaseCount new repurchase IDs for user $userId");

                    for ($i = 0; $i < $newRepurchaseCount; $i++) {
                        $this->generateRepurchaseId($userId, $planActivationController);
                    }
                } else {
                    Log::info("✅ User $userId: No new repurchase IDs needed (Available PV: $availablePv)");
                }
            }

        } catch (\Exception $e) {
            Log::error('Error in repurchase ID generation: ' . $e->getMessage());
        }
    }

    /**
     * Generate a single repurchase ID for a user
     */
    private function generateRepurchaseId($userId, $planActivationController)
    {
        try {
            // Generate unique repurchase ID
            $repurchaseId = $this->generateUniqueRepurchaseId();
            
            Log::info("🛒 Generating repurchase ID: $repurchaseId for user: $userId");

            // Create repurchase entry in mlm_plan
            $repurchasePlan = new mlm_plan();
            $repurchasePlan->memberid = $repurchaseId;
            $repurchasePlan->sponsor_id = $userId;
            $repurchasePlan->placement_id = $userId; // Same as sponsor for repurchase
            $repurchasePlan->original_id = $userId;
            $repurchasePlan->all_father_id = $userId;
            $repurchasePlan->referral_count = 0;
            $repurchasePlan->memberid_type = 'repurchase';
            $repurchasePlan->status = 0; // Pending activation
            $repurchasePlan->save();

            // Add to activation queue for processing
            $activationQueue = new plan_activation_queue();
            $activationQueue->login_id = $userId;
            $activationQueue->activation_id = $repurchaseId;
            $activationQueue->parent_activation_id = null; // Root level record
            $activationQueue->activation_status = 'pending';
            $activationQueue->status = 'success';
            $activationQueue->save();

            Log::info("✅ Successfully created repurchase ID $repurchaseId and added to activation queue");

        } catch (\Exception $e) {
            Log::error("Error generating repurchase ID for user $userId: " . $e->getMessage());
        }
    }


    /**
     * Generate unique repurchase ID with RP prefix
     */
    private function generateUniqueRepurchaseId()
    {
        do {
            $id = mt_rand(100000, 999999);
            $repurchaseId = "RP" . $id;
        } while (mlm_plan::where('memberid', $repurchaseId)->exists());
        
        return $repurchaseId;
    }

    /**
     * Process repurchase level income cutoff for active slots
     */
    private function processRepurchaseCutoff()
    {
        try {
            $logger = $this->getCutoffLogger();
            $logger->info('💰 Checking for repurchase level income cutoff processing...');

            $currentDateTime = now();

            // Check if we're in testing mode
            $testingMode = env('CUTOFF_TESTING_MODE', false);
            $bypassTimeCheck = env('CUTOFF_BYPASS_TIME_CHECK', false);
            $forceDate = env('CUTOFF_FORCE_DATE', null);
            $testTime = env('CUTOFF_TEST_TIME', '23:40:00');

            if ($testingMode) {
                $logger->warning('🧪 REPURCHASE TESTING MODE ENABLED - Production safety bypassed!');
            }

            // Override current date if forced date is set
            if ($forceDate && $testingMode) {
                $currentDateTime = \Carbon\Carbon::parse($forceDate);
                $logger->info("📅 Using forced date for repurchase testing: {$forceDate}");
            }

            $currentTime = now()->setTimezone('Asia/Kolkata')->format('H:i:s');
            
            // Build cutoff slot query - allow flexible date ranges for testing
            $query = repurchase_cutoff_slots::where('status', 'pending');
            
            // In testing mode, allow more flexible date matching
            if ($testingMode && $forceDate) {
                // For specific date testing, find cutoff that covers the forced date
                $query->where('from_date', '<=', $currentDateTime->toDateString())
                      ->where('to_date', '>=', $currentDateTime->toDateString());
                Log::info("🎯 Testing mode: Looking for cutoff covering forced date: {$currentDateTime->toDateString()}");
            } else {
                // Production mode: only today's cutoff
                $query->where('from_date', '<=', $currentDateTime->toDateString())
                      ->where('to_date', '=', $currentDateTime->toDateString());
            }

            // Add time restrictions unless bypassed in testing
            if (!$bypassTimeCheck) {
                $timeToCheck = $testingMode ? $testTime : '23:40:00';
                $query->where(\DB::raw("'$currentTime'"), '>=', $timeToCheck);
                $logger->info("⏰ Using repurchase time check: {$timeToCheck} (Current: {$currentTime})");
            } else {
                $logger->warning('⚠️ Repurchase time check bypassed for testing');
            }

            $cutoffSlot = $query->orderBy('id', 'asc')->first();

            if (!$cutoffSlot) {
                $message = $testingMode ? 'No repurchase cutoff slot found for testing' : 'No repurchase cutoff slot found for current time';
                $logger->info($message);
                return;
            }

            $minutesLeft = $currentDateTime->diffInMinutes($currentDateTime->copy()->setDateFrom($cutoffSlot->to_date)->endOfDay());
            $logger->info("Found repurchase cutoff slot '{$cutoffSlot->name}' with {$minutesLeft} minutes remaining - processing now");

            $this->processSingleCutoffSlot($cutoffSlot);
            $this->generateUniqueIncentiveIncome($cutoffSlot);
            $this->processLeadersLevelIncome($cutoffSlot);
            $this->processLeadersMatrixSystem($cutoffSlot);

        } catch (\Exception $e) {
            $logger = $this->getCutoffLogger();
            $logger->error('Error in repurchase cutoff processing: ' . $e->getMessage());
        }
    }

    /**
     * Process a single cutoff slot
     */
    private function processSingleCutoffSlot($cutoffSlot)
    {
        try {
            $logger = $this->getCutoffLogger();
            $logger->info("💰 Processing cutoff slot: {$cutoffSlot->name} ({$cutoffSlot->from_date} to {$cutoffSlot->to_date})");

            // Get all regular members from mlm_plan
            $regularMembers = mlm_plan::where('memberid_type', 'regular')
                ->join('plan_activation_queue', 'mlm_plan.memberid', '=', 'plan_activation_queue.activation_id')
                ->where('plan_activation_queue.status', 'success')
                ->select('mlm_plan.*')
                ->get();

            $logger->info('Found ' . $regularMembers->count() . ' regular members to process');

            foreach ($regularMembers as $regularMember) {
                $this->calculateRepurchaseLevelIncome($regularMember, $cutoffSlot);
            }

            // Mark cutoff slot as completed
            $cutoffSlot->status = 'success';
            $cutoffSlot->save();

            $logger->info("✅ Completed cutoff slot: {$cutoffSlot->name}");

        } catch (\Exception $e) {
            $logger = $this->getCutoffLogger();
            $logger->error("Error processing cutoff slot {$cutoffSlot->name}: " . $e->getMessage());
        }
    }

    /**
     * Calculate repurchase level income for a regular member
     */
    private function calculateRepurchaseLevelIncome($regularMember, $cutoffSlot)
    {
        try {
            $logger = $this->getCutoffLogger();
            $memberId = $regularMember->memberid;
            $logger->info("🔍 Calculating repurchase level income for regular member: $memberId");
            $logger->info("🚀 [FUNCTION START] calculateRepurchaseLevelIncome($memberId)");

            // Get 14-level hierarchy starting from this member
            $logger->info("🌳 [STEP 1] Getting 14-level hierarchy for member: $memberId");
            $hierarchy = $this->get14LevelHierarchy($memberId);
            $logger->info("📊 [RESULT] Hierarchy levels found: " . count($hierarchy));

            if (empty($hierarchy)) {
                $logger->info("⚠️ No hierarchy found for member: $memberId");
                $logger->info("🏁 [FUNCTION END] calculateRepurchaseLevelIncome($memberId) - No hierarchy");
                return;
            }

            $logger->info("📊 Hierarchy summary: " . json_encode(array_map('count', $hierarchy)));

            $totalIncome = 0;
            $totalRepurchases = 0;
            $logger->info("🔄 [STEP 2] Processing hierarchy levels 1-" . count($hierarchy));

            // Process each level in hierarchy
            foreach ($hierarchy as $level => $membersInLevel) {
                $logger->info("📦 [LEVEL $level START] Processing " . count($membersInLevel) . " members");
                $logger->info("💰 [STEP 3.$level] Calling processHierarchyLevel($level, " . count($membersInLevel) . " members, {$cutoffSlot->name}, $memberId)");
                $levelIncome = $this->processHierarchyLevel($level, $membersInLevel, $cutoffSlot, $memberId);
                $logger->info("💵 [LEVEL $level RESULT] Income: ₹{$levelIncome['income']}, Repurchases: {$levelIncome['repurchases']}");
                $totalIncome += $levelIncome['income'];
                $totalRepurchases += $levelIncome['repurchases'];
                $logger->info("📦 [LEVEL $level END] Running totals - Income: ₹$totalIncome, Repurchases: $totalRepurchases");
            }

            $logger->info("📊 [STEP 4] Final calculations complete");
            if ($totalRepurchases > 0) {
                $logger->info("💰 Member $memberId earned ₹$totalIncome from $totalRepurchases repurchases across 14 levels");
            } else {
                $logger->info("💴 Member $memberId earned no income (0 repurchases found)");
            }
            $logger->info("🏁 [FUNCTION END] calculateRepurchaseLevelIncome($memberId) - Success");

        } catch (\Exception $e) {
            $logger = $this->getCutoffLogger();
            $logger->error("Error calculating repurchase level income for member {$regularMember->memberid}: " . $e->getMessage());
        }
    }

    /**
     * Get 14-level hierarchy for a member using sponsor_id relationships
     */
    private function get14LevelHierarchy($startMemberId)
    {
        $logger = $this->getCutoffLogger();
        $logger->info("🚀 [FUNCTION START] get14LevelHierarchy($startMemberId)");
        
        $hierarchy = [];
        $currentLevelMembers = [$startMemberId];
        $logger->info("🌱 [STEP 1] Starting with root member: $startMemberId");
        
        for ($level = 1; $level <= 14; $level++) {
            $logger->info("🔍 [LEVEL $level START] Processing level $level with " . count($currentLevelMembers) . " parent members");
            
            if (empty($currentLevelMembers)) {
                $logger->info("⚠️ [LEVEL $level] No members in current level, breaking loop");
                break;
            }

            // Get all members sponsored by current level members
            $logger->info("📊 [QUERY] Finding members sponsored by: " . implode(', ', $currentLevelMembers));
            $nextLevelMembers = mlm_plan::whereIn('sponsor_id', $currentLevelMembers)
                ->where('memberid_type', 'regular') // Only include regular members
                ->where('status', 1) // Only active members
                ->pluck('memberid')
                ->toArray();
            $logger->info("📊 [RESULT] Found " . count($nextLevelMembers) . " regular members in level $level");

            if (!empty($nextLevelMembers)) {
                $hierarchy[$level] = $nextLevelMembers;
                $currentLevelMembers = $nextLevelMembers;
                $logger->info("✅ [LEVEL $level SUCCESS] Added " . count($nextLevelMembers) . " members to hierarchy");
                $logger->info("📄 [DETAIL] Level $level members: " . implode(', ', array_slice($nextLevelMembers, 0, 10)) . (count($nextLevelMembers) > 10 ? '...' : ''));
            } else {
                $logger->info("⚠️ [LEVEL $level] No members found, ending hierarchy build");
                break;
            }
        }

        $logger->info("📊 [SUMMARY] Built " . count($hierarchy) . "-level hierarchy");
        foreach ($hierarchy as $lvl => $members) {
            $logger->info("📅 Level $lvl: " . count($members) . " members");
        }
        $logger->info("🏁 [FUNCTION END] get14LevelHierarchy($startMemberId) - Success");

        return $hierarchy;
    }

    /**
     * Process a single hierarchy level and calculate income
     */
    private function processHierarchyLevel($level, $membersInLevel, $cutoffSlot, $beneficiaryMemberId)
    {
        $logger = $this->getCutoffLogger();
        $logger->info("🚀 [FUNCTION START] processHierarchyLevel(level=$level, membersCount=" . count($membersInLevel) . ", beneficiary=$beneficiaryMemberId)");
        
        $levelIncome = 0;
        $levelRepurchases = 0;

        // Get level-specific income rate
        $logger->info("💰 [STEP 1] Getting income rate for level $level");
        $incomePerRepurchase = $this->getRepurchaseIncomeRate($level);
        $logger->info("💵 [RESULT] Income per repurchase for level $level: ₹$incomePerRepurchase");

        $logger->info("🔄 [STEP 2] Processing " . count($membersInLevel) . " members in level $level");
        foreach ($membersInLevel as $memberId) {
            $logger->info("🔍 [MEMBER START] Processing member $memberId in level $level");
            // Count repurchase IDs generated for this member during cutoff period
            $logger->info("📊 [QUERY] Counting repurchases for member $memberId between {$cutoffSlot->from_date} and {$cutoffSlot->to_date}");
            $repurchaseCount = mlm_plan::where('all_father_id', $memberId)
                ->where('memberid_type', 'repurchase')
                ->where('status', 1) // Only activated repurchases
                ->whereDate('created_at', '>=', $cutoffSlot->from_date)
                ->whereDate('created_at', '<=', $cutoffSlot->to_date)
                ->count();
            $logger->info("📊 [RESULT] Member $memberId has $repurchaseCount repurchases in cutoff period");

            if ($repurchaseCount > 0) {
                $memberIncome = $repurchaseCount * $incomePerRepurchase;
                $levelIncome += $memberIncome;
                $levelRepurchases += $repurchaseCount;
                $logger->info("💰 [INCOME CALC] Member $memberId: $repurchaseCount x ₹$incomePerRepurchase = ₹$memberIncome");

                // Create income records for each repurchase
                $logger->info("💾 [STEP 3] Getting repurchase IDs for income records");
                $repurchaseIds = mlm_plan::where('all_father_id', $memberId)
                    ->where('memberid_type', 'repurchase')
                    ->whereDate('created_at', '>=', $cutoffSlot->from_date)
                    ->whereDate('created_at', '<=', $cutoffSlot->to_date)
                    ->pluck('memberid');
                $logger->info("🆔 [RESULT] Found " . count($repurchaseIds) . " repurchase IDs: " . implode(', ', $repurchaseIds->toArray()));

                $logger->info("💾 [STEP 4] Creating income records for each repurchase");
                foreach ($repurchaseIds as $repurchaseId) {
                    $logger->info("💰 [RECORD] Creating income record: beneficiary=$beneficiaryMemberId, repurchase=$repurchaseId, level=$level, amount=₹$incomePerRepurchase");
                    $this->createRepurchaseLevelIncomeRecord(
                        $beneficiaryMemberId,
                        $repurchaseId,
                        $level,
                        $incomePerRepurchase,
                        $cutoffSlot->id
                    );
                }

                $logger->info("💰 Level $level: Member $memberId contributed $repurchaseCount repurchases = ₹$memberIncome for beneficiary $beneficiaryMemberId");
            } else {
                $logger->info("💴 Member $memberId has no repurchases in cutoff period");
            }
            $logger->info("🏁 [MEMBER END] Completed processing member $memberId in level $level");
        }

        $logger->info("📊 [LEVEL SUMMARY] Level $level totals - Income: ₹$levelIncome, Repurchases: $levelRepurchases");
        $logger->info("🏁 [FUNCTION END] processHierarchyLevel(level=$level) - Success");

        return [
            'income' => $levelIncome,
            'repurchases' => $levelRepurchases
        ];
    }

    /**
     * Get income rate per repurchase for each level (random numbers under 100 for now)
     */
    private function getRepurchaseIncomeRate($level)
    {
        // Random numbers under 100 for each level - you can modify these later
        $rates = [
            1 => 60,  2 => 50,  3 => 40,  4 => 40,  5 => 45,
            6 => 30,  7 => 15,  8 => 12,  9 => 12, 10 => 12,
           11 => 10, 12 => 10, 13 => 5, 14 => 5
        ];

        return $rates[$level] ?? 0;
    }

    /**
     * Create repurchase level income record
     */
    private function createRepurchaseLevelIncomeRecord($beneficiaryId, $repurchaseId, $level, $amount, $cutoffSlotId)
    {
        $logger = $this->getCutoffLogger();
        $logger->info("🚀 [FUNCTION START] createRepurchaseLevelIncomeRecord(beneficiary=$beneficiaryId, repurchase=$repurchaseId, level=$level, amount=₹$amount, cutoff=$cutoffSlotId)");
        
        try {
            $logger->info("💾 [STEP 1] Creating new repurchase_level_income record");
            $income = new repurchase_level_income();
            $income->memberid = $beneficiaryId;
            $income->fromId = $repurchaseId;
            $income->level = $level;
            $income->payout = $amount;
            $income->netpay = $amount;
            $income->cutoff_slot_id = $cutoffSlotId;
            
            $logger->info("💾 [STEP 2] Saving income record to database");
            $income->save();
            $logger->info("✅ [SUCCESS] Income record saved with ID: " . $income->id);

            $logger->info("💰 Created income record: ₹$amount for member $beneficiaryId from repurchase $repurchaseId (Level $level)");
            $logger->info("🏁 [FUNCTION END] createRepurchaseLevelIncomeRecord - Success");

        } catch (\Exception $e) {
            $logger->error("❌ [ERROR] Failed to create repurchase level income record: " . $e->getMessage());
            $logger->error("🏁 [FUNCTION END] createRepurchaseLevelIncomeRecord - Failed");
            throw $e;
        }
    }

    /**
     * Process awards and rewards cutoff for ranking system
     */
    private function processAwardsAndRewardsCutoff()
    {
        try {
            $logger = $this->getCutoffLogger();
            $logger->info('🏆 Checking for Awards and Rewards cutoff processing...');

            $currentDateTime = now();

            // Check if we're in testing mode
            $testingMode = env('CUTOFF_TESTING_MODE', false);
            $bypassTimeCheck = env('CUTOFF_BYPASS_TIME_CHECK', false);
            $forceDate = env('CUTOFF_FORCE_DATE', null);
            $testTime = env('CUTOFF_TEST_TIME', '23:40:00');

            if ($testingMode) {
                $logger->warning('🧪 AWARDS TESTING MODE ENABLED - Production safety bypassed!');
            }

            // Override current date if forced date is set
            if ($forceDate && $testingMode) {
                $currentDateTime = \Carbon\Carbon::parse($forceDate);
                $logger->info("📅 Using forced date for awards testing: {$forceDate}");
            }

            $currentTime = now()->setTimezone('Asia/Kolkata')->format('H:i:s');
            
            // Build cutoff slot query - allow flexible date ranges for testing
            $query = awards_and_rewards_cutoff_slots::where('status', 'pending');
            
            // In testing mode, allow more flexible date matching
            if ($testingMode && $forceDate) {
                // For specific date testing, find cutoff that covers the forced date
                $query->where('from_date', '<=', $currentDateTime->toDateString())
                      ->where('to_date', '>=', $currentDateTime->toDateString());
                $logger->info("🎯 Testing mode: Looking for awards cutoff covering forced date: {$currentDateTime->toDateString()}");
            } else {
                // Production mode: only today's cutoff
                $query->where('from_date', '<=', $currentDateTime->toDateString())
                      ->where('to_date', '=', $currentDateTime->toDateString());
            }

            // Add time restrictions unless bypassed in testing
            if (!$bypassTimeCheck) {
                $timeToCheck = $testingMode ? $testTime : '23:40:00';
                $query->where(\DB::raw("'$currentTime'"), '>=', $timeToCheck);
                $logger->info("⏰ Using awards time check: {$timeToCheck} (Current: {$currentTime})");
            } else {
                $logger->warning('⚠️ Awards time check bypassed for testing');
            }

            $cutoffSlot = $query->orderBy('id', 'asc')->first();

            if (!$cutoffSlot) {
                $message = $testingMode ? 'No awards cutoff slot found for testing' : 'No awards cutoff slot found for current time';
                $logger->info($message);
                return;
            }

            $minutesLeft = $currentDateTime->diffInMinutes($currentDateTime->copy()->setDateFrom($cutoffSlot->to_date)->endOfDay());
            $logger->info("Found awards cutoff slot '{$cutoffSlot->name}' with {$minutesLeft} minutes remaining - processing now");

            $this->processSingleAwardsCutoffSlot($cutoffSlot);

        } catch (\Exception $e) {
            $logger = $this->getCutoffLogger();
            $logger->error('Error in awards and rewards cutoff processing: ' . $e->getMessage());
        }
    }

    /**
     * Process a single awards cutoff slot
     */
    private function processSingleAwardsCutoffSlot($cutoffSlot)
    {
        try {
            Log::info("🏆 Processing awards cutoff slot: {$cutoffSlot->name} ({$cutoffSlot->from_date} to {$cutoffSlot->to_date})");

            // Get all regular members from mlm_plan
            $regularMembers = mlm_plan::where('memberid_type', 'regular')
                ->where('status', 1)
                ->get();

            Log::info('Found ' . $regularMembers->count() . ' regular members to evaluate for awards');

            $totalAchievements = 0;
            $totalRewards = 0;

            foreach ($regularMembers as $member) {
                $achievements = $this->evaluateMemberRankAchievements($member->memberid, $cutoffSlot);
                $totalAchievements += $achievements;

                if ($achievements > 0) {
                    $rewards = $this->processRewardEligibility($member->memberid, $cutoffSlot);
                    $totalRewards += $rewards;
                }
            }

            // Mark cutoff slot as completed
            $cutoffSlot->status = 'success';
            $cutoffSlot->save();

            Log::info("✅ Completed awards cutoff slot: {$cutoffSlot->name} - {$totalAchievements} achievements, {$totalRewards} rewards awarded");

        } catch (\Exception $e) {
            Log::error("Error processing awards cutoff slot {$cutoffSlot->name}: " . $e->getMessage());
        }
    }

    /**
     * Evaluate member rank achievements for all levels
     * Modified: One level progression per cutoff - members can only advance one level at a time
     */
    private function evaluateMemberRankAchievements($memberId, $cutoffSlot)
    {
        $achievements = 0;

        Log::info("🔍 Evaluating rank achievements for member: $memberId");

        // Get member's current highest achieved level from rank_progress table
        $currentLevel = $this->getMemberCurrentLevel($memberId);
        Log::info("📊 Member $memberId current level: $currentLevel");

        // Determine the next level they can achieve (one step forward)
        $targetLevel = $currentLevel + 1;
        
        if ($targetLevel > 14) {
            Log::info("Member $memberId already at maximum level 14");
            return 0;
        }

        Log::info("🎯 Evaluating member $memberId for level $targetLevel progression");

        // Build 14-level hierarchy starting from this member
        $hierarchy = $this->get14LevelHierarchy($memberId);

        if (empty($hierarchy)) {
            Log::info("No hierarchy found for member: $memberId");
            return 0;
        }

        // Check if they qualify for the target level (one step ahead)
        $levelMembers = $hierarchy[$targetLevel] ?? [];
        
        if (!empty($levelMembers)) {
            // Count repurchases in this level during cutoff period
            $levelRepurchaseCount = $this->countLevelRepurchases($levelMembers, $cutoffSlot);

            // Check if member achieved the required count for this level
            if ($this->checkLevelAchievement($memberId, $targetLevel, $levelRepurchaseCount, $cutoffSlot)) {
                $achievements = 1;
                Log::info("🎉 Member $memberId progressed from Level $currentLevel to Level $targetLevel");
            } else {
                Log::info("❌ Member $memberId did not qualify for Level $targetLevel (needs more repurchases)");
            }
        } else {
            Log::info("❌ Member $memberId has no members at Level $targetLevel in hierarchy");
        }

        return $achievements;
    }

    /**
     * Get member's current highest achieved level from rank_progress table
     */
    private function getMemberCurrentLevel($memberId)
    {
        // Get the highest level this member has achieved (with achievement_count > 0)
        $highestLevel = rank_progress::where('memberid', $memberId)
            ->where('achievement_count', '>', 0)
            ->max('level');

        return $highestLevel ?? 0; // Return 0 if no achievements yet
    }

    /**
     * Count repurchases for a specific level during cutoff period
     */
    private function countLevelRepurchases($levelMembers, $cutoffSlot)
    {
        if (empty($levelMembers)) {
            return 0;
        }

        return mlm_plan::where('memberid_type', 'repurchase')
            ->where('status', 1)
            ->whereIn('all_father_id', $levelMembers)
            ->whereDate('created_at', '>=', $cutoffSlot->from_date)
            ->whereDate('created_at', '<=', $cutoffSlot->to_date)
            ->count();
    }

    /**
     * Check if member achieved a specific level
     */
    private function checkLevelAchievement($memberId, $level, $levelRepurchaseCount, $cutoffSlot)
    {
        // Level requirements from the PRD
        $levelRequirements = [
            1 => 2,       // Bronze Wellness Warrior
            2 => 6,       // Silver Star Achiever
            3 => 18,      // Gold Elite Performer
            4 => 54,      // Platinum Pioneer
            5 => 162,     // Pearl of Excellence
            6 => 486,     // Dynamic Distributor
            7 => 1458,    // UCWC Ambassador
            8 => 4374,    // Diamond Ambassador
            9 => 13122,   // Elite Ambassador
            10 => 39366,  // Titan Ambassador
            11 => 118098, // Double Diamond Director
            12 => 354294, // Double Elite Director
            13 => 1062882, // Double Titan Director
            14 => 3188646  // Crown Director
        ];

        $requiredCount = $levelRequirements[$level] ?? 0;

        if ($levelRepurchaseCount < $requiredCount) {
            return false;
        }

        // For Level 2+, check that ALL lower levels are also achieved in same cutoff
        if ($level > 1) {
            if (!$this->checkAllLowerLevelsAchieved($memberId, $level, $cutoffSlot)) {
                return false;
            }
        }

        // Member achieved this level - update rank progress and rank
        $this->updateMemberRankProgress($memberId, $level);
        $this->updateMemberCurrentRank($memberId, $level);

        Log::info("🎉 Member {$memberId} achieved Level {$level} with {$levelRepurchaseCount} repurchases");

        return true;
    }

    /**
     * Check that all lower levels are achieved in same cutoff
     */
    private function checkAllLowerLevelsAchieved($memberId, $currentLevel, $cutoffSlot)
    {
        // Check that ALL levels from 1 to (currentLevel-1) are achieved in same cutoff
        $hierarchy = $this->get14LevelHierarchy($memberId);

        $levelRequirements = [
            1 => 2, 2 => 6, 3 => 18, 4 => 54, 5 => 162, 6 => 486, 7 => 1458,
            8 => 4374, 9 => 13122, 10 => 39366, 11 => 118098, 12 => 354294,
            13 => 1062882, 14 => 3188646
        ];

        for ($level = 1; $level < $currentLevel; $level++) {
            $levelMembers = $hierarchy[$level] ?? [];
            $levelRepurchaseCount = $this->countLevelRepurchases($levelMembers, $cutoffSlot);
            $requiredCount = $levelRequirements[$level] ?? 0;

            if ($levelRepurchaseCount < $requiredCount) {
                Log::info("❌ Member {$memberId} failed Level {$currentLevel} - Level {$level} only has {$levelRepurchaseCount}/{$requiredCount} repurchases");
                return false;
            }
        }

        return true;
    }

    /**
     * Update member rank progress tracking
     */
    private function updateMemberRankProgress($memberId, $level)
    {
        $rankProgress = rank_progress::firstOrCreate(
            ['memberid' => $memberId, 'level' => $level],
            ['achievement_count' => 0]
        );

        $rankProgress->achievement_count++;
        $rankProgress->save();

        Log::info("📊 Updated rank progress for {$memberId} Level {$level}: {$rankProgress->achievement_count} achievements");
    }

    /**
     * Update member current rank display and eligibility status
     */
    private function updateMemberCurrentRank($memberId, $level)
    {
        $rankProgress = rank_progress::where('memberid', $memberId)
            ->where('level', $level)
            ->first();

        if (!$rankProgress) {
            return;
        }

        $achievementCount = $rankProgress->achievement_count;
        $rankName = $this->getRankName($level, $achievementCount);

        // Set eligible_1 and eligible_2 as boolean indicators based on achievement count
        $eligible1 = ($achievementCount >= 1) ? 1 : 0;
        $eligible2 = ($achievementCount >= 2) ? 1 : 0;

        // Update rank (full name with suffix), eligible_1, and eligible_2 in mlm_plan table
        mlm_plan::where('memberid', $memberId)
            ->update([
                'rank' => $rankName  // Full rank name with "Eligible 1/2" suffix
            ]);

        Log::info("🏅 Updated rank for {$memberId}: {$rankName}, eligible_1: {$eligible1}, eligible_2: {$eligible2}");
    }


    
     /**
     * Generate unique incentive income 
     */

    private function generateUniqueIncentiveIncome($cutoffSlot)
    {
        try {
            $logger = $this->getCutoffLogger();
            $logger->info("🎯 Starting Unique Incentive Income Generation");
            $logger->info("💰 Processing cutoff slot: {$cutoffSlot->name} ({$cutoffSlot->from_date} to {$cutoffSlot->to_date})");

            // Get all delivered orders in the cutoff period from active members
            $orders = \DB::table('ecom_orders')
                        ->join('mlm_plan', 'ecom_orders.user_id', '=', 'mlm_plan.memberid')
                        ->select('ecom_orders.id as order_id', 'ecom_orders.user_id')
                        ->whereDate('ecom_orders.created_at', '>=', $cutoffSlot->from_date)
                        ->whereDate('ecom_orders.created_at', '<=', $cutoffSlot->to_date)
                        ->where('ecom_orders.status', '=', 'delivered')
                        ->where('mlm_plan.status', 0) // Only active members
                        ->get();
            
            if ($orders->isEmpty()) {
                $logger->info("ℹ️ No ecom orders found in cutoff period - skipping unique incentive income generation");
                return;
            }

            $logger->info("📊 Found {$orders->count()} orders in cutoff period");
     
            foreach ($orders as $order) {
                $orderId = $order->order_id;
                $userId = $order->user_id;

                $logger->info("🚀 [ORDER START] Processing order {$orderId} for user {$userId}");

                // Get all items for this order from ecom_order_items table
                $orderItems = \DB::table('ecom_order_items')
                    ->where('order_id', $orderId)
                    ->get();
                
                if ($orderItems->isEmpty()) {
                    $logger->info("⚠️ No items found for order {$orderId}");
                    continue;
                }

                $logger->info("📦 Found {$orderItems->count()} items in order {$orderId}");

                foreach ($orderItems as $item) {
                    $logger->info("🔍 [ITEM START] Processing item {$item->product_id} from order {$orderId}");
                    
                    // Get incentive percentage from product model
                    $product = \App\Models\Product::where('id', $item->product_id)->first();
                    $incentivePercentage = $product->incentive ?? 0;
                    
                    // Calculate incentive amount for this item
                    $itemValue = $item->quantity * $item->price;
                    $itemIncentiveAmount = ($itemValue * $incentivePercentage) / 100;
                    
                    $logger->info("💰 Item {$item->product_id}: Qty={$item->quantity}, Price=₹{$item->price}, Value=₹{$itemValue}, Incentive={$incentivePercentage}%, Amount=₹{$itemIncentiveAmount}");

                    if ($itemIncentiveAmount <= 0) {
                        $logger->info("⏭️ Skipping item {$item->product_id} - no incentive amount");
                        continue;
                    }

                    // Distribute this item's incentive amount up sponsor hierarchy
                    $this->distributeItemIncentive($orderId, $item->product_id, $userId, $itemIncentiveAmount, $incentivePercentage, $itemValue);
                    
                    $logger->info("🏁 [ITEM END] Completed processing item {$item->product_id}");
                }
                
                $logger->info("🏁 [ORDER END] Completed processing order {$orderId}");
            }

            $logger->info("✅ Completed Unique Incentive Income Generation for all orders");

        } catch (\Exception $e) {
            $logger = $this->getCutoffLogger();
            $logger->error('Error in unique incentive income generation: ' . $e->getMessage());
            $logger->error('Stack trace: ' . $e->getTraceAsString());
        }
    }

    /**
     * Distribute a single item's incentive amount up the sponsor hierarchy
     */
    private function distributeItemIncentive($orderId, $productId, $userId, $totalAmount, $incentivePercentage, $itemValue)
    {
        $logger = $this->getCutoffLogger();
        $logger->info("🔗 [DISTRIBUTION START] Distributing ₹{$totalAmount} for product {$productId} from order {$orderId}");
        
        try {
            // Start distribution from the order user
            $currentMemberId = $userId;
            $remainingAmount = $totalAmount;
            $previousMemberId = $userId; // For fromId column
            $levelCount = 0; // Track distribution levels
            
            $logger->info("🔗 [STEP 1] Starting upline distribution for order {$orderId} product {$productId}");
            
            // Continue until amount is fully distributed or no sponsor found
            while ($remainingAmount > 0.01) { // Using 0.01 to avoid floating point issues
                $levelCount++;
                $logger->info("📊 [LEVEL $levelCount START] Remaining amount: ₹$remainingAmount");
                
                if ($levelCount > 20) { // Safety limit to prevent infinite loops
                    $logger->warning("⚠️ Distribution stopped at level {$levelCount} to prevent infinite loop for order {$orderId}");
                    break;
                }
                
                // Get the sponsor of current member
                $logger->info("📊 [QUERY] Finding sponsor for member: $currentMemberId");
                $sponsor_id = mlm_plan::where('memberid', $currentMemberId)->value('sponsor_id');
                
                // If no sponsor exists, stop the process
                if (!$sponsor_id) {
                    $logger->info("🔚 No sponsor found for member {$currentMemberId} - stopping distribution at level {$levelCount}");
                    break;
                }

                $logger->info("📈 Level {$levelCount}: Found sponsor {$sponsor_id} for member {$currentMemberId}");

                // Get total purchase value for receiver (sponsor)
                $logger->info("📊 [VALIDATION] Checking sponsor {$sponsor_id} purchase history");
                $receiverPurchase = \DB::table('ecom_orders')
                    ->join('mlm_plan', 'ecom_orders.user_id', '=', 'mlm_plan.memberid')
                    ->where('ecom_orders.user_id', '=', $sponsor_id)
                    ->where('ecom_orders.status', '=', 'delivered')
                    ->sum('ecom_orders.total');

                $logger->info("💳 [RESULT] Sponsor {$sponsor_id} has total purchase value: ₹{$receiverPurchase}");

                // If receiver has insufficient purchases, skip them
                if ($receiverPurchase < 500) {
                    $logger->info("⏭️ [SKIP] Skipping sponsor {$sponsor_id} - insufficient purchase value (₹{$receiverPurchase} < ₹500)");
                    // Move to next level without giving income
                    $currentMemberId = $sponsor_id;
                    continue;
                }
                
                // Calculate 75% for current sponsor
                $currentPayout = round($remainingAmount * 0.75, 2);
                
                $logger->info("💰 [CALCULATION] Level {$levelCount}: Paying ₹{$currentPayout} to sponsor {$sponsor_id} (75% of ₹{$remainingAmount})");
                
                // Create income entry for current sponsor
                $logger->info("💾 [STEP 2] Creating unique incentive income record");
                $transaction = new unique_incentive_income();
                $transaction->order_id = $orderId; // Use actual order ID from ecom_orders
                $transaction->product_id = $productId; // Product ID from order items
                $transaction->fromId = $previousMemberId;
                $transaction->memberid = $sponsor_id;
                $transaction->all_father_id = $userId; // Original order user
                $transaction->order_value = $itemValue; // Individual item value
                $transaction->bonus_percentage = $incentivePercentage;
                $transaction->payout = $currentPayout;
                $transaction->netpay = $currentPayout;
                $transaction->eldate = now();
                $logger->info("💾 [SAVE] Saving transaction for order {$orderId} product {$productId}");
                $transaction->save();
                $logger->info("✅ [SUCCESS] Transaction saved with ID: " . $transaction->id);
                
                $logger->info("✅ Created incentive income record: ₹{$currentPayout} for sponsor {$sponsor_id} from {$previousMemberId}");
                
                // Update remaining amount (25% goes to next level)
                $remainingAmount = round($remainingAmount * 0.25, 2);
                
                $logger->info("📊 [STEP 3] Remaining amount for next level: ₹{$remainingAmount}");
                
                // Move up the hierarchy
                $previousMemberId = $sponsor_id;
                $currentMemberId = $sponsor_id;
                $logger->info("📈 [LEVEL $levelCount END] Moving to next level with current member: $currentMemberId");
            }
            
            $logger->info("🏁 [DISTRIBUTION END] Completed distribution for order {$orderId} product {$productId} after {$levelCount} levels");

        } catch (\Exception $e) {
            $logger->error("Error distributing item incentive for order {$orderId} product {$productId}: " . $e->getMessage());
        }
    }
    /**
     * Process Leaders Level Income for active cutoff slots
     */
    private function processLeadersLevelIncome($cutoffSlot)
    {
        try {
            $logger = $this->getCutoffLogger();
            $logger->info('👑 Processing Leaders Level Income for cutoff slot...');

            // Get all regular members from mlm_plan
            $regularMembers = mlm_plan::where('memberid_type', 'regular')
                ->join('plan_activation_queue', 'mlm_plan.memberid', '=', 'plan_activation_queue.activation_id')
                ->where('plan_activation_queue.status', 'success')
                ->select('mlm_plan.*')
                ->get();

            $logger->info('Found ' . $regularMembers->count() . ' regular members for leaders level income processing');

            foreach ($regularMembers as $regularMember) {
                $this->calculateLeadersLevelIncome($regularMember, $cutoffSlot);
            }

            $logger->info("✅ Completed Leaders Level Income processing for cutoff slot: {$cutoffSlot->name}");

        } catch (\Exception $e) {
            $logger = $this->getCutoffLogger();
            $logger->error('Error in Leaders Level Income processing: ' . $e->getMessage());
        }
    }

    /**
     * Calculate leaders level income for a regular member (All 3 levels)
     */
    private function calculateLeadersLevelIncome($regularMember, $cutoffSlot)
    {
        $logger = $this->getCutoffLogger();
        try {
            $memberId = $regularMember->memberid;
            $logger->info("🚀 [FUNCTION START] calculateLeadersLevelIncome($memberId)");
            $logger->info("👑 Calculating leaders level income for regular member: $memberId");

            // Check if this is member's first cutoff - skip if so
            $logger->info("🔍 [STEP 1] Checking if this is member's first cutoff");
            if ($this->isMemberFirstCutoff($regularMember, $cutoffSlot)) {
                $logger->info("⏭️ Skipping first cutoff for member: $memberId (created: {$regularMember->created_at})");
                $logger->info("🏁 [FUNCTION END] calculateLeadersLevelIncome($memberId) - Skipped (first cutoff)");
                return;
            }
            $logger->info("✅ [RESULT] Not first cutoff, proceeding with leaders level income calculation");

            // Get 3-level hierarchy 
            $logger->info("🌳 [STEP 2] Getting 14-level hierarchy (will use levels 1-3)");
            $hierarchy = $this->get14LevelHierarchy($memberId);

            if (empty($hierarchy)) {
                $logger->info("⚠️ No hierarchy found for member: $memberId");
                $logger->info("🏁 [FUNCTION END] calculateLeadersLevelIncome($memberId) - No hierarchy");
                return;
            }
            $logger->info("📊 [RESULT] Hierarchy found with " . count($hierarchy) . " levels");

            // Process levels 1, 2, and 3
            $logger->info("🔄 [STEP 3] Processing leaders level income for levels 1-3");
            for ($level = 1; $level <= 3; $level++) {
                $logger->info("📦 [LEVEL $level START] Processing level $level for leaders income");
                if (isset($hierarchy[$level]) && !empty($hierarchy[$level])) {
                    $levelMembers = $hierarchy[$level];
                    $logger->info("✅ [FOUND] Processing " . count($levelMembers) . " level $level members for $memberId");
                    
                    foreach ($levelMembers as $levelMemberId) {
                        $logger->info("🚀 [MEMBER] Calling processLevelMemberForLeadersIncome for level $level member: $levelMemberId");
                        $this->processLevelMemberForLeadersIncome($memberId, $levelMemberId, $level, $cutoffSlot);
                    }
                } else {
                    $logger->info("⚠️ No level $level hierarchy found for member: $memberId");
                }
                $logger->info("📦 [LEVEL $level END] Completed level $level processing");
            }
            $logger->info("🏁 [FUNCTION END] calculateLeadersLevelIncome($memberId) - Success");

        } catch (\Exception $e) {
            $logger->error("❌ [ERROR] Error calculating leaders level income for member {$regularMember->memberid}: " . $e->getMessage());
            $logger->error("🏁 [FUNCTION END] calculateLeadersLevelIncome({$regularMember->memberid}) - Failed");
            throw $e;
        }
    }

    /**
     * Process a single level member for leaders income (supports all levels)
     */
    private function processLevelMemberForLeadersIncome($beneficiaryId, $levelMemberId, $level, $cutoffSlot)
    {
        try {
            // Count repurchases for this level member during cutoff period
            $repurchaseCount = mlm_plan::where('all_father_id', $levelMemberId)
                ->where('memberid_type', 'repurchase')
                ->where('status', 1)
                ->whereDate('created_at', '>=', $cutoffSlot->from_date)
                ->whereDate('created_at', '<=', $cutoffSlot->to_date)
                ->count();

            Log::info("Level $level member $levelMemberId has $repurchaseCount repurchases in cutoff period");

            // Get or create tracking record
            $tracking = $this->getOrCreateLevelTrackingRecord($beneficiaryId, $levelMemberId, $level, $cutoffSlot);
            
            // Update tracking with current period data
            $tracking->repurchase_count = $repurchaseCount;
            $tracking->total_accumulated_count += $repurchaseCount;

            Log::info("Member $beneficiaryId -> Level$level $levelMemberId: Current=$repurchaseCount, Total={$tracking->total_accumulated_count}");

            // Check for income eligibility based on level
            $this->checkAndGenerateLeadersIncomeByLevel($beneficiaryId, $levelMemberId, $level, $tracking, $cutoffSlot);

            $tracking->save();

        } catch (\Exception $e) {
            Log::error("Error processing level $level member $levelMemberId for leaders income: " . $e->getMessage());
        }
    }

    /**
     * Check and generate leaders income based on level-specific rules
     */
    private function checkAndGenerateLeadersIncomeByLevel($beneficiaryId, $levelMemberId, $level, $tracking, $cutoffSlot)
    {
        $totalCount = $tracking->total_accumulated_count;
        $lastPaidThreshold = $tracking->last_paid_threshold;
        
        // Define level-specific rules
        $levelConfig = [
            1 => ['threshold' => 10, 'amount' => 500, 'increment' => 5, 'increment_amount' => 250, 'use_consecutive' => true],
            2 => ['threshold' => 100, 'amount' => 5000, 'increment' => 100, 'increment_amount' => 5000, 'use_consecutive' => false],
            3 => ['threshold' => 1000, 'amount' => 75000, 'increment' => 1000, 'increment_amount' => 75000, 'use_consecutive' => false]
        ];
        
        $config = $levelConfig[$level] ?? null;
        if (!$config) {
            Log::warning("No configuration found for level $level");
            return;
        }
        
        if ($level == 1) {
            // Level 1 uses consecutive logic (existing logic)
            $this->processLevel1ConsecutiveIncome($beneficiaryId, $levelMemberId, $tracking, $cutoffSlot);
        } else {
            // Level 2 and 3 use cumulative total logic
            $this->processCumulativeIncome($beneficiaryId, $levelMemberId, $level, $tracking, $cutoffSlot, $config);
        }
    }
    
    /**
     * Process Level 1 consecutive income (existing logic)
     */
    private function processLevel1ConsecutiveIncome($beneficiaryId, $level1MemberId, $tracking, $cutoffSlot)
    {
        // Get previous cutoff tracking to check consecutive requirement
        $previousTracking = $this->getPreviousTrackingRecord($beneficiaryId, $level1MemberId, $cutoffSlot);
        
        if ($previousTracking && $previousTracking->repurchase_count > 0) {
            // Continue consecutive count
            $tracking->consecutive_count = $previousTracking->consecutive_count + $tracking->repurchase_count;
        } else {
            // Start new consecutive count
            $tracking->consecutive_count = $tracking->repurchase_count;
        }
        
        $consecutiveCount = $tracking->consecutive_count;
        
        // Rule: Must have >= 10 repurchases in consecutive cutoffs
        if ($consecutiveCount < 10) {
            Log::info("Level 1: Not enough consecutive count ($consecutiveCount < 10) for income generation");
            return;
        }

        // Calculate total income: ₹500 base + ₹250 for each additional 5-count unit above 10
        $totalIncome = 500; // Base income for reaching 10
        $paidUnits = 1; // Base unit for reaching 10
        
        if ($consecutiveCount >= 15) {
            $additionalUnits = floor(($consecutiveCount - 10) / 5);
            $totalIncome += ($additionalUnits * 250);
            $paidUnits += $additionalUnits;
        }
        
        // Calculate remaining count to carry forward
        $paidCount = 10 + (($paidUnits - 1) * 5); // Total count for which income was paid
        $remainingCount = $consecutiveCount - $paidCount;

        Log::info("Level 1: Generating leaders income: Base=₹500, Total=₹$totalIncome, PaidCount=$paidCount, RemainingCount=$remainingCount");

        // Create income record
        $this->createLeadersLevelIncomeRecord($beneficiaryId, $level1MemberId, $totalIncome, $consecutiveCount, $cutoffSlot, 1);

        // Generate LL members based on consecutive count
        $this->generateLeadersMatrixMembers($beneficiaryId, $consecutiveCount, $cutoffSlot);

        // Update tracking
        $tracking->is_qualified = true;
        $tracking->last_income_at = now();
        $tracking->total_income_paid += $totalIncome;
        
        // Carry forward remaining count to next cutoff (don't reset to 0)
        $tracking->consecutive_count = $remainingCount;

        Log::info("✅ Generated Level 1 leaders income: ₹$totalIncome for $beneficiaryId from level1 $level1MemberId");
    }
    
    /**
     * Process cumulative income for Level 2 and 3
     */
    private function processCumulativeIncome($beneficiaryId, $levelMemberId, $level, $tracking, $cutoffSlot, $config)
    {
        $totalCount = $tracking->total_accumulated_count;
        $lastPaidThreshold = $tracking->last_paid_threshold;
        $threshold = $config['threshold'];
        $amount = $config['amount'];
        $increment = $config['increment'];
        $incrementAmount = $config['increment_amount'];
        
        if ($totalCount < $threshold) {
            Log::info("Level $level: Not enough total count ($totalCount < $threshold) for income generation");
            return;
        }
        
        // Calculate how many complete thresholds have been reached
        $completedThresholds = floor($totalCount / $increment);
        $alreadyPaidThresholds = floor($lastPaidThreshold / $increment);
        $newThresholds = $completedThresholds - $alreadyPaidThresholds;
        
        if ($newThresholds <= 0) {
            Log::info("Level $level: No new thresholds reached for income generation");
            return;
        }
        
        // Calculate total income to pay
        $totalIncome = $newThresholds * $incrementAmount;
        
        Log::info("Level $level: Paying for $newThresholds new thresholds = ₹$totalIncome (Total count: $totalCount, Amount per threshold: ₹$incrementAmount)");
        
        // Create income record
        $this->createLeadersLevelIncomeRecord($beneficiaryId, $levelMemberId, $totalIncome, $totalCount, $cutoffSlot, $level);
        
        // Update tracking
        $tracking->is_qualified = true;
        $tracking->last_income_at = now();
        $tracking->total_income_paid += $totalIncome;
        $tracking->last_paid_threshold = $completedThresholds * $increment;
        
        Log::info("✅ Generated Level $level leaders income: ₹$totalIncome for $beneficiaryId from level$level $levelMemberId");
    }

    /**
     * Check if this is the member's first cutoff since creation
     */
    private function isMemberFirstCutoff($regularMember, $cutoffSlot)
    {
        try {
            $memberCreatedAt = $regularMember->created_at;
            $cutoffFromDate = $cutoffSlot->from_date;
            
            // Find the first cutoff slot that occurred after member's creation
            $firstEligibleCutoff = repurchase_cutoff_slots::where('from_date', '>', $memberCreatedAt->toDateString())
                ->orderBy('from_date', 'asc')
                ->first();
            
            if (!$firstEligibleCutoff) {
                // No cutoff found after member creation, so this is definitely first
                return true;
            }
            
            // Check if current cutoff is the first eligible one
            $isFirstCutoff = ($cutoffSlot->id == $firstEligibleCutoff->id);
            
            Log::info("Member {$regularMember->memberid}: Created={$memberCreatedAt->toDateString()}, FirstEligibleCutoff={$firstEligibleCutoff->from_date}, CurrentCutoff={$cutoffFromDate}, IsFirst=" . ($isFirstCutoff ? 'YES' : 'NO'));
            
            return $isFirstCutoff;
            
        } catch (\Exception $e) {
            Log::error("Error checking first cutoff for member {$regularMember->memberid}: " . $e->getMessage());
            // Default to allowing processing if error occurs
            return false;
        }
    }

    /**
     * Generate LL members based on consecutive count pattern
     */
    private function generateLeadersMatrixMembers($beneficiaryId, $consecutiveCount, $cutoffSlot)
    {
        try {
            // Calculate how many LL members should exist based on consecutive count
            // 10 count = 1 member, 15 count = 2 members, 20 count = 3 members, etc.
            $expectedLLMembers = 0;
            if ($consecutiveCount >= 10) {
                $expectedLLMembers = 1 + floor(($consecutiveCount - 10) / 5);
            }

            if ($expectedLLMembers <= 0) {
                return;
            }

            // Count existing LL members for this beneficiary
            $existingLLMembers = mlm_plan::where('all_father_id', $beneficiaryId)
                ->where('memberid_type', 'leader_level')
                ->count();

            $newMembersToGenerate = $expectedLLMembers - $existingLLMembers;

            if ($newMembersToGenerate <= 0) {
                Log::info("No new LL members needed for $beneficiaryId (Expected: $expectedLLMembers, Existing: $existingLLMembers)");
                return;
            }

            Log::info("🏆 Generating $newMembersToGenerate new LL members for $beneficiaryId (Expected: $expectedLLMembers, Existing: $existingLLMembers)");

            for ($i = 0; $i < $newMembersToGenerate; $i++) {
                $this->generateSingleLLMember($beneficiaryId, $cutoffSlot);
            }

        } catch (\Exception $e) {
            Log::error("Error generating LL members for $beneficiaryId: " . $e->getMessage());
        }
    }

    /**
     * Generate a single LL member and place in leaders matrix tree
     */
    private function generateSingleLLMember($originalMemberId, $cutoffSlot)
    {
        try {
            // Generate unique LL ID
            $llId = $this->generateUniqueLLId();
            
            Log::info("🏆 Generating LL member: $llId for original member: $originalMemberId");

            // Get original member plan
            $originalPlan = mlm_plan::where('memberid', $originalMemberId)->first();
            if (!$originalPlan) {
                Log::error("Original member $originalMemberId not found in mlm_plan");
                return false;
            }

            // Create LL member entry in mlm_plan
            $llPlan = new mlm_plan();
            $llPlan->memberid = $llId;
            $llPlan->sponsor_id = $originalPlan->sponsor_id;
            $llPlan->placement_id = $originalPlan->placement_id;
            $llPlan->referral_count = 0;
            $llPlan->FullName = $originalPlan->FullName;
            $llPlan->memberid_type = 'leader_level';
            $llPlan->original_id = $originalPlan->original_id ?? $originalMemberId;
            $llPlan->all_father_id = $originalMemberId; // Track the leaders level patriarch
            $llPlan->status = 1; // Directly activated
            $llPlan->save();

            // Place directly in leaders matrix tree (no activation queue)
            $planActivationController = new PlanActivationController();
            $success = $planActivationController->placeInTree('leaders_matrix_tree', $llId, $originalPlan->sponsor_id, 1, 'global');

            if ($success) {
                Log::info("✅ Successfully placed LL member $llId in leaders matrix tree");
                return true;
            } else {
                Log::error("❌ Failed to place LL member $llId in leaders matrix tree");
                // Rollback the mlm_plan entry
                $llPlan->delete();
                return false;
            }

        } catch (\Exception $e) {
            Log::error("Error generating single LL member for $originalMemberId: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Generate unique LL ID with LL prefix
     */
    private function generateUniqueLLId()
    {
        do {
            $id = mt_rand(100000, 999999);
            $llId = "LL" . $id;
        } while (mlm_plan::where('memberid', $llId)->exists());
        
        return $llId;
    }

    /**
     * Process Leaders Matrix System - income generation and rebirth handling
     */
    private function processLeadersMatrixSystem($cutoffSlot)
    {
        try {
            $logger = $this->getCutoffLogger();
            $logger->info('🏆 Processing Leaders Matrix System for income generation and rebirths...');

            // Get all LL members that were placed in leaders matrix tree
            $llMembers = mlm_plan::where('memberid_type', 'leader_level')
                ->where('status', 1)
                ->get();

            if ($llMembers->isEmpty()) {
                $logger->info('No LL members found in leaders matrix tree');
                return;
            }

            $logger->info('Found ' . $llMembers->count() . ' LL members for leaders matrix processing');

            $incomeController = new IncomeController();

            foreach ($llMembers as $llMember) {
                $this->processLLMemberIncome($llMember, $incomeController, $cutoffSlot);
            }

            $logger->info("✅ Completed Leaders Matrix System processing for cutoff slot: {$cutoffSlot->name}");

        } catch (\Exception $e) {
            $logger = $this->getCutoffLogger();
            $logger->error('Error in Leaders Matrix System processing: ' . $e->getMessage());
        }
    }

    /**
     * Process income for a single LL member in leaders matrix tree
     */
    private function processLLMemberIncome($llMember, $incomeController, $cutoffSlot)
    {
        try {
            $llMemberId = $llMember->memberid;
            
            // Check if LL member is placed in leaders matrix tree
            $treeEntry = leaders_matrix_tree::where('memberid', $llMemberId)->first();
            if (!$treeEntry) {
                Log::info("LL member $llMemberId not found in leaders_matrix_tree, skipping");
                return;
            }

            $treeNo = $treeEntry->tree_no;
            $parentId = $treeEntry->placement_id;

            Log::info("🏆 Processing LL member $llMemberId in leaders matrix tree $treeNo under parent $parentId");

            // Generate leaders matrix income (₹500 like global tree but fixed amount)
            $this->generateLeadersMatrixIncome($llMemberId, $parentId, $treeNo, $cutoffSlot);

            // Check for rebirth generation (same logic as global tree - 3 direct children)
            $directChildrenCount = $this->getDirectChildrenCountInLeadersMatrix($parentId, $treeNo);
            
            if ($directChildrenCount == 3) {
                // Check if rebirth already generated for this parent in this tree
                $existingRebirths = mlm_plan::where('all_father_id', $parentId)
                    ->where('memberid_type', 'leaders_level_rebirth')
                    ->get();

                $rebirthExistsInTree = false;
                foreach ($existingRebirths as $rebirth) {
                    $rebirthTreeEntry = leaders_matrix_tree::where('memberid', $rebirth->memberid)
                        ->where('tree_no', $treeNo)
                        ->first();
                    if ($rebirthTreeEntry) {
                        $rebirthExistsInTree = true;
                        break;
                    }
                }

                if (!$rebirthExistsInTree) {
                    $this->generateLeadersLevelRebirth($parentId, $treeNo);
                }
            }

        } catch (\Exception $e) {
            Log::error("Error processing LL member {$llMember->memberid}: " . $e->getMessage());
        }
    }

    /**
     * Generate leaders matrix income (₹500 fixed amount)
     */
    private function generateLeadersMatrixIncome($llMemberId, $parentId, $treeNo, $cutoffSlot)
    {
        try {
            // Count direct children for the parent
            $directChildrenCount = $this->getDirectChildrenCountInLeadersMatrix($parentId, $treeNo);
            
            Log::info("🏆 Leaders Matrix Income: Parent $parentId has $directChildrenCount direct children in tree $treeNo");

            if ($directChildrenCount == 1) {
                // First child - parent gets ₹500
                $this->createLeadersMatrixIncomeRecord($parentId, $llMemberId, $treeNo, 500);
                Log::info("💰 First child: Parent $parentId gets ₹500 for first direct LL child $llMemberId");
                
            } elseif ($directChildrenCount == 2) {
                // Second child - grandparent gets ₹500
                $grandParentId = $this->getParentIdInLeadersMatrix($parentId, $treeNo);
                if ($grandParentId) {
                    $this->createLeadersMatrixIncomeRecord($grandParentId, $llMemberId, $treeNo, 500);
                    Log::info("💰 Second child: Grandparent $grandParentId gets ₹500 for $parentId's second direct LL child $llMemberId");
                } else {
                    Log::info("⚠️ No grandparent found for parent $parentId in leaders matrix tree - second child income skipped");
                }
                
            } elseif ($directChildrenCount == 3) {
                // Third child - rebirth will be generated
                Log::info("🎯 Third child: Parent $parentId will get leaders level rebirth generated in tree $treeNo");
            }

        } catch (\Exception $e) {
            Log::error("Error generating leaders matrix income for LL member $llMemberId: " . $e->getMessage());
        }
    }

    /**
     * Create leaders matrix income record
     */
    private function createLeadersMatrixIncomeRecord($beneficiaryId, $triggerNodeId, $treeNo, $amount)
    {
        try {
            $income = new leaders_matrix_income();
            $income->memberid = $beneficiaryId;
            $income->fromId = $triggerNodeId;
            $income->tree_number = $treeNo;
            $income->payout = $amount;
            $income->netpay = $amount;
            $income->ignored = 0;
            $income->save();

            Log::info("💰 Created leaders matrix income record: ₹$amount for member $beneficiaryId from LL member $triggerNodeId in tree $treeNo");

        } catch (\Exception $e) {
            Log::error("Error creating leaders matrix income record: " . $e->getMessage());
        }
    }

    /**
     * Get direct children count in leaders matrix tree
     */
    private function getDirectChildrenCountInLeadersMatrix($memberId, $treeNo)
    {
        return leaders_matrix_tree::where('placement_id', $memberId)
            ->where('tree_no', $treeNo)
            ->count();
    }

    /**
     * Get parent ID in leaders matrix tree
     */
    private function getParentIdInLeadersMatrix($memberId, $treeNo)
    {
        $tree = leaders_matrix_tree::where('memberid', $memberId)
            ->where('tree_no', $treeNo)
            ->first();
        return $tree ? $tree->placement_id : null;
    }

    /**
     * Generate leaders level rebirth when parent gets 3 direct children in leaders matrix tree
     */
    private function generateLeadersLevelRebirth($originalMemberId, $treeNo)
    {
        try {
            Log::info("🏆 Generating leaders level rebirth for member: $originalMemberId in tree $treeNo");

            // Generate unique LR ID
            $rebirthId = $this->generateUniqueLRId();
            
            // Get original member plan
            $originalPlan = mlm_plan::where('memberid', $originalMemberId)->first();
            if (!$originalPlan) {
                Log::error("Original member $originalMemberId not found for rebirth generation");
                return false;
            }

            // Create rebirth entry in mlm_plan
            $rebirthPlan = new mlm_plan();
            $rebirthPlan->memberid = $rebirthId;
            $rebirthPlan->sponsor_id = $originalPlan->sponsor_id;
            $rebirthPlan->placement_id = $originalPlan->placement_id;
            $rebirthPlan->referral_count = 0;
            $rebirthPlan->FullName = $originalPlan->FullName;
            $rebirthPlan->memberid_type = 'leaders_level_rebirth';
            $rebirthPlan->original_id = $originalPlan->original_id ?? $originalMemberId;
            $rebirthPlan->all_father_id = $originalPlan->all_father_id ?? $originalMemberId; // Track the leaders level patriarch
            $rebirthPlan->status = 1; // Directly activated
            $rebirthPlan->save();

            // Place directly in leaders matrix tree (no activation queue)
            $planActivationController = new PlanActivationController();
            $success = $planActivationController->placeInTree('leaders_matrix_tree', $rebirthId, $originalPlan->sponsor_id, 1, 'global');

            if ($success) {
                Log::info("✅ Successfully created and placed leaders level rebirth $rebirthId in leaders matrix tree");
                return true;
            } else {
                Log::error("❌ Failed to place leaders level rebirth $rebirthId in leaders matrix tree");
                // Rollback the mlm_plan entry
                $rebirthPlan->delete();
                return false;
            }

        } catch (\Exception $e) {
            Log::error("Error generating leaders level rebirth for $originalMemberId: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Generate unique LR ID with LR prefix for leaders level rebirth
     */
    private function generateUniqueLRId()
    {
        do {
            $id = mt_rand(100000, 999999);
            $lrId = "LR" . $id;
        } while (mlm_plan::where('memberid', $lrId)->exists());
        
        return $lrId;
    }

    /**
     * Create leaders level income record
     */
    private function createLeadersLevelIncomeRecord($beneficiaryId, $fromId, $amount, $repurchaseCount, $cutoffSlot, $level = 1)
    {
        try {
            $income = new leaders_level_income();
            $income->memberid = $beneficiaryId;
            $income->fromId = $fromId;
            $income->level = $level;
            $income->payout = $amount;
            $income->netpay = $amount;
            $income->cutoff_slot_id = $cutoffSlot->id;
            $income->repurchase_count = $repurchaseCount;
            $income->save();

            Log::info("💰 Created leaders level income record: ₹$amount for member $beneficiaryId from level$level $fromId");

        } catch (\Exception $e) {
            Log::error("Error creating leaders level income record: " . $e->getMessage());
        }
    }

    /**
     * Get or create tracking record for specific level
     */
    private function getOrCreateLevelTrackingRecord($beneficiaryId, $levelMemberId, $level, $cutoffSlot)
    {
        $levelMemberIdField = "level_{$level}_memberid";
        
        return leaders_level_tracking::firstOrCreate(
            [
                'memberid' => $beneficiaryId,
                $levelMemberIdField => $levelMemberId,
                'level' => $level,
                'cutoff_slot_id' => $cutoffSlot->id
            ],
            [
                'repurchase_count' => 0,
                'total_accumulated_count' => 0,
                'consecutive_count' => 0,
                'total_income_paid' => 0,
                'last_paid_threshold' => 0,
                'is_qualified' => false
            ]
        );
    }

    /**
     * Get previous cutoff tracking record for level 1 (consecutive logic)
     */
    private function getPreviousTrackingRecord($beneficiaryId, $level1MemberId, $cutoffSlot)
    {
        // Find the previous cutoff slot
        $previousCutoff = repurchase_cutoff_slots::where('to_date', '<', $cutoffSlot->from_date)
            ->orderBy('to_date', 'desc')
            ->first();

        if (!$previousCutoff) {
            return null;
        }

        return leaders_level_tracking::where('memberid', $beneficiaryId)
            ->where('level_1_memberid', $level1MemberId)
            ->where('level', 1)
            ->where('cutoff_slot_id', $previousCutoff->id)
            ->first();
    }

    /**
     * Reset consecutive count when no repurchases in current period
     */
    private function resetConsecutiveCount($beneficiaryId, $level1MemberId, $cutoffSlot)
    {
        $tracking = $this->getOrCreateTrackingRecord($beneficiaryId, $level1MemberId, $cutoffSlot);
        $tracking->repurchase_count = 0;
        $tracking->consecutive_count = 0; // Reset consecutive count
        $tracking->save();

        Log::info("Reset consecutive count for $beneficiaryId -> Level1 $level1MemberId (no repurchases this period)");
    }
    private function getRankName($level, $achievementCount)
    {
        $levelNames = [
            1 => 'Bronze Wellness Warrior',
            2 => 'Silver Star Achiever',
            3 => 'Gold Elite Performer',
            4 => 'Platinum Pioneer',
            5 => 'Pearl of Excellence',
            6 => 'Dynamic Distributor',
            7 => 'UCWC Ambassador',
            8 => 'Diamond Ambassador',
            9 => 'Elite Ambassador',
            10 => 'Titan Ambassador',
            11 => 'Double Diamond Director',
            12 => 'Double Elite Director',
            13 => 'Double Titan Director',
            14 => 'Crown Director'
        ];

        $baseName = $levelNames[$level] ?? 'UCWC DISTRIBUTOR';

        if ($achievementCount == 1) {
            return $baseName . ' Eligible 1';
        } elseif ($achievementCount == 2) {
            return $baseName . ' Eligible 2';
        } elseif ($achievementCount >= 3) {
            return $baseName;
        }

        return 'UCWC DISTRIBUTOR';
    }

    /**
     * Process reward eligibility for qualified members
     */
    private function processRewardEligibility($memberId, $cutoffSlot)
    {
        $member = mlm_plan::where('memberid', $memberId)->first();
        if (!$member) {
            return 0;
        }

        $currentRank = $member->rank;
        $reward = $this->getRewardForRank($currentRank);

        if ($reward) {
            // Check if already awarded this reward in this cutoff
            $existingAward = awarded_members::where('memberid', $memberId)
                ->where('award', $reward)
                ->where('cutoff_slot_id', $cutoffSlot->id)
                ->first();

            if (!$existingAward) {
                // Create award record
                awarded_members::create([
                    'memberid' => $memberId,
                    'award' => $reward,
                    'cutoff_slot_id' => $cutoffSlot->id
                ]);

                Log::info("🎁 Awarded {$reward} to {$memberId} for achieving {$currentRank}");
                return 1;
            }
        }

        return 0;
    }

    /**
     * Get reward for specific rank
     */
    private function getRewardForRank($rank)
    {
        $rewardMapping = [
            'Pearl of Excellence' => 'kerala_tour',
            'Dynamic Distributor' => 'goa_tour',
            'UCWC Ambassador' => 'gadgets',
            'Diamond Ambassador' => 'thailand_tour',
            'Elite Ambassador' => 'gold',
            'Titan Ambassador' => 'cruise_tour',
            'Double Diamond Director' => 'car',
            'Double Elite Director' => 'dubai_tour',
            'Double Titan Director' => 'luxury_car',
            'Crown Director' => 'luxury_villa'
        ];

        return $rewardMapping[$rank] ?? null;
    }

    /**
     * Process pending activations with dynamic priority (children first, then original records)
     */
    private function processPendingActivationsWithPriority($planActivationController)
    {
        try {
            $processedCount = 0;
            $maxIterations = 100; // Prevent infinite loops
            $iteration = 0;

            while ($iteration < $maxIterations) {
                $iteration++;

                // First, get records that have children waiting (priority processing)
                $recordsWithChildren = plan_activation_queue::where('activation_status', 'pending')
                    ->whereExists(function($query) {
                        $query->select(\DB::raw(1))
                              ->from('plan_activation_queue as child')
                              ->whereRaw('child.parent_activation_id = plan_activation_queue.id')
                              ->where('child.activation_status', 'pending');
                    })
                    ->orderBy('id', 'asc')
                    ->limit(5)
                    ->get();

                // If no records with children, get original records (no parent)
                if ($recordsWithChildren->isEmpty()) {
                    $recordsToProcess = plan_activation_queue::where('activation_status', 'pending')
                        ->whereNull('parent_activation_id')
                        ->orderBy('id', 'asc')
                        ->limit(10)
                        ->get();
                } else {
                    $recordsToProcess = $recordsWithChildren;
                    Log::info("🎯 Processing {$recordsToProcess->count()} records with waiting children");
                }

                if ($recordsToProcess->isEmpty()) {
                    Log::info("No more pending activations to process");
                    break;
                }

                foreach ($recordsToProcess as $activation) {
                    if ($this->hasFailedOrProcessingRecords()) {
                        Log::error('Failed or processing records detected during processing. Stopping job execution.');
                        return;
                    }

                    $success = $this->processSingleActivation($activation, $planActivationController);
                    
                    if (!$success) {
                        Log::error('Stopping processing due to activation failure');
                        return;
                    }

                    $processedCount++;

                    // After successful processing, immediately process any children generated
                    $this->processChildrenRecords($activation->id, $planActivationController);
                }

                // Safety check: if we've processed many records, break to avoid timeout
                if ($processedCount >= 50) {
                    Log::info("Processed $processedCount records in this run, stopping to avoid timeout");
                    break;
                }
            }

            Log::info("Completed processing with $processedCount total records processed in $iteration iterations");

        } catch (\Exception $e) {
            Log::error('Error in processPendingActivationsWithPriority: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Process a single activation record
     */
    private function processSingleActivation($activation, $planActivationController)
    {
        try {
            Log::info('Processing activation for member: ' . $activation->activation_id);

            // Mark as processing to avoid double-processing
            $activation->activation_status = 'processing';
            $activation->save();

            // Validate member exists and is ready for activation
            if (!$this->validateMemberForActivation($activation->activation_id)) {
                $activation->activation_status = 'failed';
                $activation->save();
                Log::error('Member validation failed for: ' . $activation->activation_id);
                return false;
            }

            // Process the activation based on member type
            $mlmPlan = mlm_plan::where('memberid', $activation->activation_id)->first();
            
            // Special handling for global_tree_rebirth - isolated processing
            if ($mlmPlan && $mlmPlan->memberid_type === 'global_tree_rebirth') {
                $success = $this->processGlobalTreeRebirthActivation($activation, $mlmPlan);
            } else {
                // Standard processing for all other member types
                $success = $planActivationController->processPlanActivation($activation->activation_id);
            }

            if ($success) {
                // Mark as successful
                $activation->activation_date = now();
                $activation->activation_status = 'success';
                $activation->save();

                // update status = '1' in mlm_plan
                $mlmPlan = mlm_plan::where('memberid', $activation->activation_id)->first();
                if ($mlmPlan) {
                    $mlmPlan->status = 1; // Set status to activated
                    $mlmPlan->save();
                    
                    // Add topup entry for regular members only (exclude global_tree_rebirth)
                    if ($mlmPlan->memberid_type !== 'global_tree_rebirth') {
                        $this->addTopupForRegularMember($activation, $mlmPlan);
                    }
                    
                } else {
                    Log::error('MLM Plan not found for member: ' . $activation->activation_id);
                    $activation->activation_status = 'failed';
                    $activation->save();
                    return false;
                }
                
                Log::info('Successfully processed activation for member: ' . $activation->activation_id);
                
                // Update referral count for sponsor (exclude global_tree_rebirth)
                if ($mlmPlan && $mlmPlan->memberid_type !== 'global_tree_rebirth') {
                    $this->updateSponsorReferralCount($activation->activation_id);
                }
                
                return true;
                
            } else {
                // Mark as failed
                $activation->activation_status = 'failed';
                $activation->save();
                Log::error('Failed to process activation for member: ' . $activation->activation_id);
                return false;
            }

        } catch (\Exception $e) {
            // Handle individual activation failures
            $activation->activation_status = 'failed';
            $activation->save();
            Log::error('Error processing activation for member ' . $activation->activation_id . ': ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Process all children records for a parent activation ID
     */
    private function processChildrenRecords($parentActivationId, $planActivationController)
    {
        try {
            // Get all pending children for this parent
            $childrenRecords = plan_activation_queue::where('parent_activation_id', $parentActivationId)
                ->where('activation_status', 'pending')
                ->orderBy('id', 'asc')
                ->get();

            if ($childrenRecords->isEmpty()) {
                return;
            }

            Log::info("👶 Processing {$childrenRecords->count()} children records for parent activation ID: $parentActivationId");

            foreach ($childrenRecords as $childRecord) {
                $success = $this->processSingleActivation($childRecord, $planActivationController);
                
                if (!$success) {
                    Log::error("Failed to process child record: {$childRecord->activation_id}");
                    continue; // Continue with other children instead of stopping
                }

                // Recursively process any grandchildren
                $this->processChildrenRecords($childRecord->id, $planActivationController);
            }

        } catch (\Exception $e) {
            Log::error('Error processing children records: ' . $e->getMessage());
        }
    }
}