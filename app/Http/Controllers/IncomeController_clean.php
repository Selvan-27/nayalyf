<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\re_ignite_income;
use App\Models\team_performance_income;
use App\Models\global_bonus_income;
use App\Models\fast_track_income;
use App\Models\mlm_plan;
use App\Models\team_performance_tree;
use App\Models\global_tree;
use App\Models\fast_track_tree;
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
        1 => 125, 2 => 250, 3 => 500, 4 => 1000, 5 => 2000
    ];

    protected $fastTrackAmounts = [
        1 => 125, 2 => 500
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
            $isPassedToRoot = false;
            
            // Step 1: Parent P gets an income event (increment their count)
            $currentIncomeCount = $this->getIncomeCount($parentId, $treeNo);
            $newIncomeCount = $currentIncomeCount + 1;
            
            Log::info("📊 Parent $parentId income count: $currentIncomeCount → $newIncomeCount");
            $cascade[] = ['node' => $parentId, 'income_count_after' => $newIncomeCount, 'action' => 'evaluate'];

            $current = $parentId;
            $currentCount = $newIncomeCount;

            // Cascade loop
            while (true) {
                if ($currentCount % 3 !== 0) {
                    // Current member keeps the payout
                    $beneficiary = $current;
                    $cascade[count($cascade) - 1]['action'] = 'keep';
                    Log::info("💰 Member $beneficiary keeps payout (count: $currentCount, not divisible by 3)");
                    break;
                } else {
                    // Pass upward
                    $parent = $this->getParentId($current, $treeNo, 'team_performance');
                    if (!$parent) {
                        // Root keeps it even if multiple of 3
                        $beneficiary = $current;
                        $cascade[count($cascade) - 1]['action'] = 'keep';
                        $isPassedToRoot = true;
                        Log::info("🏆 Root member $beneficiary keeps payout (count: $currentCount, no parent to pass to) - PASSED TO ROOT");
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

            // Create the income record for the final beneficiary
            $this->createTeamPerformanceIncomeRecord($beneficiary, $triggerMemberId, $treeNo, $currentCount, $isPassedToRoot);
            
            Log::info("🎉 Team Performance cascade completed: " . json_encode($cascade));

        } catch (\Exception $e) {
            Log::error("Error in handleTeamPlacement: " . $e->getMessage());
        }
    }

    /**
     * Get income count for a member in a specific tree
     * Counts existing income records to determine current position
     */
    protected function getIncomeCount($memberId, $treeNo)
    {
        return team_performance_income::where('memberid', $memberId)
            ->where('tree_number', $treeNo)
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
    protected function createTeamPerformanceIncomeRecord($beneficiaryId, $triggerNodeId, $treeNo, $incomeCount, $isPassedToRoot = false)
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
                // Income passed to root is also ignored
                $ignored = 1;
                Log::info("🚫 Marking income as ignored: Passed to root member $beneficiaryId");
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
     * Generate Global Bonus Income - Count-Based Cascade Logic
     * Same logic as team performance but with different amounts
     */
    public function generateGlobalBonusIncome($newMemberId, $parentId, $treeNo)
    {
        try {
            Log::info("🌍 Global Bonus Income triggered: New member $newMemberId placed under parent $parentId in tree $treeNo");

            // Start the cascade from the direct parent
            $this->handleGlobalBonusPlacement($newMemberId, $parentId, $treeNo);

            return true;

        } catch (\Exception $e) {
            Log::error("Error generating Global Bonus Income: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Handle global bonus placement according to count-based cascade logic
     */
    protected function handleGlobalBonusPlacement($triggerMemberId, $parentId, $treeNo)
    {
        try {
            $amount = $this->globalBonusAmounts[$treeNo] ?? 0;
            if ($amount <= 0) {
                Log::warning("No global bonus amount configured for tree $treeNo");
                return;
            }

            $cascade = [];
            $isPassedToRoot = false;
            
            // Step 1: Parent P gets an income event (increment their count)
            $currentIncomeCount = $this->getGlobalBonusIncomeCount($parentId, $treeNo);
            $newIncomeCount = $currentIncomeCount + 1;
            
            Log::info("📊 Parent $parentId global bonus income count: $currentIncomeCount → $newIncomeCount");
            $cascade[] = ['node' => $parentId, 'income_count_after' => $newIncomeCount, 'action' => 'evaluate'];

            $current = $parentId;
            $currentCount = $newIncomeCount;

            // Cascade loop
            while (true) {
                if ($currentCount % 3 !== 0) {
                    // Current member keeps the payout
                    $beneficiary = $current;
                    $cascade[count($cascade) - 1]['action'] = 'keep';
                    Log::info("💰 Member $beneficiary keeps global bonus payout (count: $currentCount, not divisible by 3)");
                    break;
                } else {
                    // Pass upward
                    $parent = $this->getParentId($current, $treeNo, 'global');
                    if (!$parent) {
                        // Root keeps it even if multiple of 3
                        $beneficiary = $current;
                        $cascade[count($cascade) - 1]['action'] = 'keep';
                        $isPassedToRoot = true;
                        Log::info("🏆 Root member $beneficiary keeps global bonus payout (count: $currentCount, no parent to pass to) - PASSED TO ROOT");
                        break;
                    }
                    
                    // Pass to parent and increment their count
                    $parentCurrentCount = $this->getGlobalBonusIncomeCount($parent, $treeNo);
                    $parentNewCount = $parentCurrentCount + 1;
                    
                    Log::info("⬆️ Passing global bonus up from $current (count: $currentCount) to parent $parent (count: $parentCurrentCount → $parentNewCount)");
                    $cascade[] = ['node' => $parent, 'income_count_after' => $parentNewCount, 'action' => 'evaluate'];
                    
                    $current = $parent;
                    $currentCount = $parentNewCount;
                }
            }

            // Create the income record for the final beneficiary
            $this->createGlobalBonusIncomeRecord($beneficiary, $triggerMemberId, $treeNo, $currentCount, $isPassedToRoot);
            
            Log::info("🎉 Global Bonus cascade completed: " . json_encode($cascade));

        } catch (\Exception $e) {
            Log::error("Error in handleGlobalBonusPlacement: " . $e->getMessage());
        }
    }

    /**
     * Get global bonus income count for a member in a specific tree
     */
    protected function getGlobalBonusIncomeCount($memberId, $treeNo)
    {
        return global_bonus_income::where('memberid', $memberId)
            ->where('tree_number', $treeNo)
            ->count();
    }

    /**
     * Create global bonus income record
     */
    protected function createGlobalBonusIncomeRecord($beneficiaryId, $triggerNodeId, $treeNo, $incomeCount, $isPassedToRoot = false)
    {
        try {
            $amount = $this->globalBonusAmounts[$treeNo] ?? 0;
            
            // Determine if this income should be ignored
            $ignored = 0;
            if ($incomeCount <= 2) {
                // First two incomes for any member are ignored
                $ignored = 1;
                Log::info("🚫 Marking global bonus as ignored: First 2 incomes for member $beneficiaryId (count: $incomeCount)");
            } elseif ($isPassedToRoot) {
                // Income passed to root is also ignored
                $ignored = 1;
                Log::info("🚫 Marking global bonus as ignored: Passed to root member $beneficiaryId");
            }
            
            Log::info("💵 Creating global bonus income record: Beneficiary=$beneficiaryId, Amount=₹$amount, Trigger=$triggerNodeId, Count=$incomeCount, Ignored=$ignored, Tree=$treeNo");
            
            if ($amount > 0) {
                $income = new global_bonus_income();
                $income->memberid = $beneficiaryId;
                $income->fromId = $triggerNodeId;
                $income->tree_number = $treeNo;
                $income->payout = $amount;
                $income->netpay = $amount;
                $income->ignored = $ignored;
                $income->save();

                if ($ignored) {
                    Log::info("🚫 Global Bonus Income: ₹$amount created for beneficiary: $beneficiaryId (count: $incomeCount) - IGNORED");
                } else {
                    Log::info("✅ Global Bonus Income: ₹$amount created for beneficiary: $beneficiaryId (count: $incomeCount) triggered by: $triggerNodeId");
                }
            } else {
                Log::warning("⚠️ No global bonus amount configured for tree $treeNo, skipping income record creation");
            }
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
                $existingIncome = fast_track_income::where('beneficiary_id', $memberId)
                    ->where('tree_number', $treeNo)
                    ->first();

                if (!$existingIncome) {
                    $income = new fast_track_income();
                    $income->beneficiary_id = $memberId;
                    $income->tree_number = $treeNo;
                    $income->payout = $amount;
                    $income->netpay = $amount;
                    $income->save();

                    Log::info("Successfully generated Fast Track Income: ₹$amount for member: $memberId");
                }
            }

            return true;

        } catch (\Exception $e) {
            Log::error("Error generating Fast Track Income: " . $e->getMessage());
            return false;
        }
    }
}
