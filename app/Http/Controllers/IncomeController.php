<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\re_ignite_income;
use App\Models\team_performance_income;
use App\Models\global_bonus_income;
use App\Models\fast_track_income;
use App\Models\achievement_level_income;
use App\Models\mlm_plan;
use App\Models\team_performance_tree;
use App\Models\global_tree;
use App\Models\fast_track_tree;
use App\Models\achievement_tree;
use App\Http\Controllers\tree_traversal_controller;
use Illuminate\Support\Facades\Log;

class IncomeController extends Controller
{
    protected $treeTraversalController;

    // Income amounts by tree number
    protected $teamPerformanceAmounts = [
        1 => 200, 2 => 400, 3 => 800, 4 => 1600, 5 => 3200, 6 => 6400, 7 => 12800,
        8 => 25600, 9 => 51200, 10 => 102400, 11 => 204800, 12 => 409600, 13 => 819200, 14 => 1638400
    ];

    protected $globalBonusAmounts = [
        1 => 125  // Fixed amount for global tree
    ];

    protected $fastTrackAmounts = [
        1 => 125, 2 => 500
    ];

    // Achievement income amounts by level
    protected $achievementIncomeAmounts = [
        // 1 => 100,      // Level 1: 3 members = ₹100/month
        // 2 => 200,      // Level 2: 9 members = ₹200/month
        // 3 => 500,      // Level 3: 27 members = ₹500/month
        // 4 => 750,      // Level 4: 81 members = ₹750/month
        // 5 => 1000,     // Level 5: 243 members = ₹1,000/month
        6 => 1000,     // Level 6: 729 members = ₹1,000/month
        7 => 2000,     // Level 7: 2,187 members = ₹2,000/month
        8 => 4000,     // Level 8: 6,561 members = ₹4,000/month
        9 => 8000,     // Level 9: 19,683 members = ₹8,000/month
        10 => 25000,   // Level 10: 59,049 members = ₹25,000/month
        11 => 75000,   // Level 11: 177,147 members = ₹75,000/month
        12 => 125000,  // Level 12: 531,441 members = ₹125,000/month
        13 => 400000,  // Level 13: 1,594,323 members = ₹400,000/month
        14 => 1000000  // Level 14: 4,782,969 members = ₹1,000,000/month
    ];

    public function __construct()
    {
        $this->treeTraversalController = new tree_traversal_controller();
    }

    /**
     * Generate Reignite Income when rebirth ID is generated from Global Tree
     */
    public function generateReigniteIncome($rebirthId, $originalId)
    {
        try {
            Log::info("Generating Reignite Income: ₹160 for original_id: $originalId from rebirth_id: $rebirthId");

            $income = new re_ignite_income();
            $income->memberid = $originalId;
            $income->fromId = $rebirthId;
            $income->payout = 160;
            $income->netpay = 160;
            $income->save();

            Log::info("Successfully generated Reignite Income for original_id: $originalId");
            return true;

        } catch (\Exception $e) {
            Log::error("Error generating Reignite Income: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Generate Team Performance Income - Count-Based Cascade Logic
     * Based on PRD: when new node is placed under parent P, only P gets an income event initially
     */
    public function generateTeamPerformanceIncome($newMemberId, $parentId, $treeNo)
    {
        try {
            Log::info("🎯 Team Performance Income triggered: New member $newMemberId placed under parent $parentId in tree $treeNo");

            // Start the cascade from the direct parent
            $this->handleTeamPlacement($newMemberId, $parentId, $treeNo);

            return true;

        } catch (\Exception $e) {
            Log::error("Error generating Team Performance Income: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Handle team placement according to PRD count-based cascade logic
     */
    protected function handleTeamPlacement($triggerMemberId, $parentId, $treeNo)
    {
        try {
            $amount = $this->teamPerformanceAmounts[$treeNo] ?? 0;
            if ($amount <= 0) {
                Log::warning("No amount configured for tree $treeNo");
                return;
            }

            $cascade = [];
            
            // Step 1: Parent P gets an income event (increment their count)
            $currentIncomeCount = $this->getIncomeCount($parentId, $treeNo);
            $newIncomeCount = $currentIncomeCount + 1;
            
            Log::info("📊 Parent $parentId income count: $currentIncomeCount → $newIncomeCount");
            $cascade[] = ['node' => $parentId, 'income_count_after' => $newIncomeCount, 'action' => 'evaluate'];

            $current = $parentId;
            $currentCount = $newIncomeCount;

            // Cascade loop - record income at every step
            while (true) {
                if ($currentCount % 3 !== 0) {
                    // Current member keeps the payout - record as regular income
                    $beneficiary = $current;
                    $cascade[count($cascade) - 1]['action'] = 'keep';
                    
                    // Record the income for the keeper
                    $this->createTeamPerformanceIncomeRecord($beneficiary, $triggerMemberId, $treeNo, $currentCount, false, false);
                    
                    Log::info("💰 Member $beneficiary keeps payout (count: $currentCount, not divisible by 3)");
                    break;
                } else {
                    // Pass upward - record ignored income for current member
                    $this->createTeamPerformanceIncomeRecord($current, $triggerMemberId, $treeNo, $currentCount, false, true);
                    Log::info("⬆️ Member $current passes up payout (count: $currentCount, divisible by 3) - recorded as IGNORED");
                    
                    $parent = $this->getParentId($current, $treeNo, 'team_performance');
                    if (!$parent) {
                        // Root keeps it even if multiple of 3 - this was already recorded above as ignored
                        // But root also gets income for receiving the pass-up - mark as ignored=2
                        $this->createTeamPerformanceIncomeRecord($current, $triggerMemberId, $treeNo, $currentCount, true, false);
                        
                        $cascade[count($cascade) - 1]['action'] = 'keep_as_root';
                        Log::info("🏆 Root member $current keeps payout (count: $currentCount, no parent to pass to) - recorded as ROOT INCOME with ignored=2");
                        break;
                    }
                    
                    // Pass to parent and increment their count
                    $parentCurrentCount = $this->getIncomeCount($parent, $treeNo);
                    $parentNewCount = $parentCurrentCount + 1;
                    
                    Log::info("⬆️ Passing up from $current (count: $currentCount) to parent $parent (count: $parentCurrentCount → $parentNewCount)");
                    $cascade[] = ['node' => $parent, 'income_count_after' => $parentNewCount, 'action' => 'evaluate'];
                    
                    $current = $parent;
                    $currentCount = $parentNewCount;
                }
            }
            
            Log::info("🎉 Team Performance cascade completed: " . json_encode($cascade));

        } catch (\Exception $e) {
            Log::error("Error in handleTeamPlacement: " . $e->getMessage());
        }
    }

    /**
     * Get income count for a member in a specific tree
     * Counts existing income records to determine current position
     * Skips records where ignored=2 (root pass-up incomes)
     */
    protected function getIncomeCount($memberId, $treeNo)
    {
        return team_performance_income::where('memberid', $memberId)
            ->where('tree_number', $treeNo)
            ->where('ignored', '!=', 2)
            ->count();
    }

    /**
     * Get parent ID from tree for a given member
     * Returns null if member is root or not found
     */
    protected function getParentId($memberId, $treeNo, $treeType = 'team_performance')
    {
        switch ($treeType) {
            case 'team_performance':
                $tree = team_performance_tree::where('memberid', $memberId)
                    ->where('tree_no', $treeNo)
                    ->first();
                return $tree ? $tree->placement_id : null;
                
            case 'global':
                $tree = global_tree::where('memberid', $memberId)
                    ->where('tree_no', $treeNo)
                    ->first();
                return $tree ? $tree->placement_id : null;
                
            case 'fast_track':
                $tree = fast_track_tree::where('memberid', $memberId)
                    ->where('tree_no', $treeNo)
                    ->first();
                return $tree ? $tree->placement_id : null;
                
            default:
                return null;
        }
    }

    /**
     * Create team performance income record
     */
    protected function createTeamPerformanceIncomeRecord($beneficiaryId, $triggerNodeId, $treeNo, $incomeCount, $isPassedToRoot = false, $isPasserIgnored = false)
    {
        try {
            $amount = $this->teamPerformanceAmounts[$treeNo] ?? 0;
            
            // Determine if this income should be ignored
            $ignored = 0;
            if ($incomeCount <= 2) {
                // First two incomes for any member are ignored
                $ignored = 1;
                Log::info("🚫 Marking income as ignored: First 2 incomes for member $beneficiaryId (count: $incomeCount)");
            } elseif ($isPassedToRoot) {
                // Income passed to root is marked as ignored=2
                $ignored = 2;
                Log::info("🚫 Marking income as ignored=2: Passed to root member $beneficiaryId");
            } elseif ($isPasserIgnored) {
                // Income for the passer (who is passing up) is ignored
                $ignored = 1;
                Log::info("🚫 Marking income as ignored: Member $beneficiaryId is passing income up");
            }
            
            Log::info("💵 Creating team performance income record: Beneficiary=$beneficiaryId, Amount=₹$amount, Trigger=$triggerNodeId, Count=$incomeCount, Ignored=$ignored, Tree=$treeNo");
            
            if ($amount > 0) {
                $income = new team_performance_income();
                $income->memberid = $beneficiaryId;
                $income->fromId = $triggerNodeId;
                $income->tree_number = $treeNo;
                $income->payout = $amount;
                $income->netpay = $amount;
                $income->ignored = $ignored;
                $income->save();

                if ($ignored) {
                    Log::info("🚫 Team Performance Income: ₹$amount created for beneficiary: $beneficiaryId (count: $incomeCount) - IGNORED");
                } else {
                    Log::info("✅ Team Performance Income: ₹$amount created for beneficiary: $beneficiaryId (count: $incomeCount) triggered by: $triggerNodeId");
                }
            } else {
                Log::warning("⚠️ No amount configured for tree $treeNo, skipping income record creation");
            }
        } catch (\Exception $e) {
            Log::error("❌ Error creating team performance income record: " . $e->getMessage());
        }
    }

    /**
     * Generate Global Bonus Income - New Simple Logic
     * 1st child: Parent gets ₹120, 2nd child: Grandparent gets ₹120, 3rd child: Rebirth generated
     */
    public function generateGlobalBonusIncome($newMemberId, $parentId, $treeNo)
    {
        try {
            Log::info("🌍 Global Bonus Income triggered: New member $newMemberId placed under parent $parentId in tree $treeNo");

            // Count direct children for the parent
            $directChildrenCount = $this->getDirectChildrenCount($parentId, $treeNo, 'global');
            
            Log::info("📊 Parent $parentId now has $directChildrenCount direct children in global tree $treeNo");

            if ($directChildrenCount == 1) {
                // First child - parent gets ₹120
                $this->createGlobalBonusIncomeRecord($parentId, $newMemberId, $treeNo, 1, false, false);
                Log::info("💰 First child: Parent $parentId gets ₹120 for first direct child $newMemberId");
                
            } elseif ($directChildrenCount == 2) {
                // Second child - grandparent gets ₹120
                $grandParentId = $this->getParentId($parentId, $treeNo, 'global');
                if ($grandParentId) {
                    $this->createGlobalBonusIncomeRecord($grandParentId, $newMemberId, $treeNo, 1, false, false);
                    Log::info("💰 Second child: Grandparent $grandParentId gets ₹120 for $parentId's second direct child $newMemberId");
                } else {
                    Log::info("⚠️ No grandparent found for parent $parentId - second child income skipped");
                }
                
            } elseif ($directChildrenCount == 3) {
                // Third child - rebirth will be generated by tree progression logic
                Log::info("🎯 Third child: Parent $parentId will get global tree rebirth generated");
            }

            return true;

        } catch (\Exception $e) {
            Log::error("Error generating Global Bonus Income: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get global bonus income count for a member in a specific tree
     * Skips records where ignored=2 (root pass-up incomes)
     */
    protected function getGlobalBonusIncomeCount($memberId, $treeNo)
    {
        return global_bonus_income::where('memberid', $memberId)
            ->where('tree_number', $treeNo)
            ->where('ignored', '!=', 2)
            ->count();
    }

    /**
     * Get direct children count for a member in a specific tree
     */
    protected function getDirectChildrenCount($memberId, $treeNo, $treeType = 'global')
    {
        switch ($treeType) {
            case 'global':
                return global_tree::where('placement_id', $memberId)
                    ->where('tree_no', $treeNo)
                    ->count();
                
            case 'team_performance':
                return team_performance_tree::where('placement_id', $memberId)
                    ->where('tree_no', $treeNo)
                    ->count();
                
            default:
                return 0;
        }
    }

    /**
     * Create global bonus income record
     */
    protected function createGlobalBonusIncomeRecord($beneficiaryId, $triggerNodeId, $treeNo, $incomeCount, $isPassedToRoot = false, $isPasserIgnored = false)
    {
        try {

            $amount = 125; // Fixed amount for new global tree logic
            
            Log::info("💵 Creating global bonus income record: Beneficiary=$beneficiaryId, Amount=₹$amount, Trigger=$triggerNodeId, Tree=$treeNo");
            
            $income = new global_bonus_income();
            $income->memberid = $beneficiaryId;
            $income->fromId = $triggerNodeId;
            $income->tree_number = $treeNo;
            $income->payout = $amount;
            $income->netpay = $amount;
            $income->ignored = 0; // No ignored logic in new system
            $income->save();

            Log::info("✅ Global Bonus Income: ₹$amount created for beneficiary: $beneficiaryId triggered by: $triggerNodeId");
            
        } catch (\Exception $e) {
            Log::error("❌ Error creating global bonus income record: " . $e->getMessage());
        }
    }

    /**
     * Generate Fast Track Income when member reaches 3 direct children
     */
    public function generateFastTrackIncome($memberId, $treeNo)
    {
        try {
            Log::info("Generating Fast Track Income for member: $memberId in tree: $treeNo");

            $amount = $this->fastTrackAmounts[$treeNo] ?? 0;
            
            if ($amount > 0) {
                // Check if already paid for this tree
                $existingIncome = fast_track_income::where('memberid', $memberId)
                    ->where('tree_number', $treeNo)
                    ->first();

                if (!$existingIncome) {
                    // Find the root Fast Track patriarch by traversing up the chain
                    $allFatherId = $this->treeTraversalController->findFastTrackRootPatriarch($memberId);
                    
                    Log::info("Creating Fast Track Income record with root all_father_id: $allFatherId for member: $memberId (traced from $memberId)");

                    $income = new fast_track_income();
                    $income->memberid = $memberId;
                    $income->tree_number = $treeNo;
                    $income->payout = $amount;
                    $income->netpay = $amount;
                    $income->all_father_id = $allFatherId; // Track the Fast Track patriarch
                    $income->save();

                    Log::info("Successfully generated Fast Track Income: ₹$amount for member: $memberId with all_father_id: $allFatherId");
                }
            }

            return true;

        } catch (\Exception $e) {
            Log::error("Error generating Fast Track Income: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Check and generate achievement income for members who reach level targets
     * Called after each achievement tree placement
     */
    public function checkAchievementIncomeEligibility($memberId)
    {
        try {
            Log::info("🏆 Checking achievement income eligibility for member: $memberId");

            // Get the member's achievement tree position
            $achievementTreeEntry = achievement_tree::where('memberid', $memberId)->first();
            if (!$achievementTreeEntry) {
                Log::info("Member $memberId not found in achievement tree");
                return false;
            }

            $totalGenerated = 0;

            // Check each level from 6 to 14 for eligibility

            for ($level = 6; $level <= 14; $level++) {
                $targetCount = pow(3, $level); // 3^level (729 for 6th, 2187 for 7th, etc.)
                $incomeAmount = $this->achievementIncomeAmounts[$level] ?? 0; // Use predefined amounts

                // Count actual members in this specific level
                $actualCount = $this->countMembersInAchievementLevel($memberId, $level);
                
                Log::info("Level $level: Target=$targetCount, Actual=$actualCount, Income=₹$incomeAmount");

                if ($actualCount >= $targetCount) {
                    // Check if this member already has income records for this level
                    $existingRecords = achievement_level_income::where('memberid', $memberId)
                        ->where('level', $level)
                        ->count();

                    if ($existingRecords == 0) {
                        // Generate 12 months of income records
                        $this->generateAchievementIncomeRecords($memberId, $level, $incomeAmount);
                        $totalGenerated++;
                        Log::info("🎉 Generated achievement income for member $memberId - Level $level: ₹$incomeAmount x 12 months");
                    } else {
                        Log::info("Member $memberId already has achievement income records for level $level");
                    }
                } else {
                    Log::info("Member $memberId not eligible for level $level yet (needs " . ($targetCount - $actualCount) . " more members)");
                }
            }

            return $totalGenerated > 0;

        } catch (\Exception $e) {
            Log::error("Error checking achievement income eligibility: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Count members in a specific level of achievement tree hierarchy
     * Uses placement_id relationships to build hierarchy
     * Level 1 = Direct children, Level 2 = Grandchildren, etc.
     */
    private function countMembersInAchievementLevel($rootMemberId, $targetLevel)
    {
        try {
            $currentLevelMembers = [$rootMemberId];
            
            // Traverse down the tree level by level
            for ($level = 1; $level <= $targetLevel; $level++) {
                $nextLevelMembers = [];
                
                foreach ($currentLevelMembers as $memberId) {
                    // Find all children of this member in achievement tree
                    $children = achievement_tree::where('placement_id', $memberId)->pluck('memberid')->toArray();
                    $nextLevelMembers = array_merge($nextLevelMembers, $children);
                }
                
                $currentLevelMembers = $nextLevelMembers;
                
                if (empty($currentLevelMembers)) {
                    break; // No more levels to traverse
                }
            }
            
            $count = count($currentLevelMembers);
            Log::info("🔍 Level $targetLevel under member $rootMemberId: $count members");
            
            return $count;
            
        } catch (\Exception $e) {
            Log::error("Error counting members in achievement level: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Generate 12 months of achievement income records
     */
    private function generateAchievementIncomeRecords($memberId, $level, $monthlyAmount)
    {
        try {
            $startDate = now(); // Current date when eligibility is achieved
            
            for ($month = 1; $month <= 12; $month++) {
                // Calculate the eligible date for each month
                $eldate = $startDate->copy()->addMonths($month - 1);
                
                $income = new achievement_level_income();
                $income->memberid = $memberId;
                $income->fromId = $memberId; // Self-generated income
                $income->level = $level;
                $income->payout = $monthlyAmount;
                $income->netpay = $monthlyAmount;
                $income->eldate = $eldate->format('Y-m-d');
                $income->month_number = $month;
                $income->save();
                
                Log::info("📅 Created achievement income record: Member=$memberId, Level=$level, Month=$month, Amount=₹$monthlyAmount, ElDate=" . $eldate->format('Y-m-d'));
            }
            
        } catch (\Exception $e) {
            Log::error("Error generating achievement income records: " . $e->getMessage());
        }
    }
}
