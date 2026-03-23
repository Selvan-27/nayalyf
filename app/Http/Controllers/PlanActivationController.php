<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\plan_activation_queue;
use App\Models\mlm_plan;
use App\Models\team_performance_tree;
use App\Models\global_tree;
use App\Models\achievement_tree;
use App\Models\fast_track_tree;
use App\Models\referral_income;
use App\Http\Controllers\tree_traversal_controller;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Log;

class PlanActivationController extends Controller
{
    protected $treeTraversalController;
    protected $incomeController;

    public function __construct()
    {
        $this->treeTraversalController = new tree_traversal_controller();
        $this->incomeController = new IncomeController();
    }

    /**
     * Process plan activation for a member
     */
    public function processPlanActivation($activation_id)
    {
        try {
            Log::info('Processing plan activation for member: ' . $activation_id);

            // Check if member exists in mlm_plan
            $mlmPlan = mlm_plan::where('memberid', $activation_id)->first();
            if (!$mlmPlan) {
                Log::error('Member not found in mlm_plan: ' . $activation_id);
                return false;
            }

            // Check if member is already activated
            if ($mlmPlan->status == 1) {
                Log::warning('Member already activated: ' . $activation_id);
                return true; // Consider this successful since the goal is achieved
            }

            // Update member status to activated
            $mlmPlan->status = 1;
            if (!$mlmPlan->save()) {
                Log::error('Failed to update MLM plan status for member: ' . $activation_id);
                return false;
            }

            // Process tree placements based on member type and qualifications
            $treePlacementSuccess = $this->processTreePlacements($mlmPlan);
            if (!$treePlacementSuccess) {
                Log::error('Tree placement failed for member: ' . $activation_id);
                // Rollback the status change
                $mlmPlan->status = 0;
                $mlmPlan->save();
                return false;
            }

            // Generate IGNITE bonus for referrer if regular ID
            if ($mlmPlan->memberid_type === 'regular') {
                $bonusResult = $this->generateIgniteBonus($mlmPlan->sponsor_id, $activation_id);
                if (!$bonusResult) {
                    Log::warning('IGNITE bonus generation failed for member: ' . $activation_id . ' but continuing...');
                    // Don't fail the entire activation for bonus issues
                }
            }

            Log::info('Successfully processed plan activation for member: ' . $activation_id);
            
            // Check if this activation qualifies the sponsor for Fast Track
            $this->checkSponsorFastTrackQualification($activation_id);
            
            // Check if this repurchase activation qualifies the all_father_id for Fast Track
            if ($mlmPlan->memberid_type === 'repurchase' && $mlmPlan->all_father_id) {

                $this->checkAllFatherFastTrackQualification($mlmPlan->all_father_id, $activation_id);
            }
            
            return true;

        } catch (\Exception $e) {
            Log::error('Error processing plan activation for member ' . $activation_id . ': ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return false;
        }
    }

    /**
     * Process tree placements based on requirements
     */
    protected function processTreePlacements($mlmPlan)
    {
        $memberId = $mlmPlan->memberid;
        $sponsorId = $mlmPlan->sponsor_id;
        $memberType = $mlmPlan->memberid_type;

        Log::info('Processing tree placements for member: ' . $memberId . ' Type: ' . $memberType);

        try {
            // For regular IDs upon registration or rebirth IDs from global tree
            if ($memberType === 'regular' || $memberType === 'rebirth') {
                // Enter Tree #1 of Team Tree Group (uses team filling)
                if (!$this->placeInTree('team_performance_tree', $memberId, $sponsorId, 1, 'team')) {
                    Log::error('Failed to place member in team_performance_tree');
                    return false;
                }
                
              //  Enter Tree #1 of Global Tree Group (uses global filling)
                if (!$this->placeInTree('global_tree', $memberId, $sponsorId, 1, 'global')) {
                    Log::error('Failed to place member in global_tree');
                    return false;
                }
                
                // Enter Tree #1 of Achievement Tree Group (uses team filling)
                if (!$this->placeInTree('achievement_tree', $memberId, $sponsorId, 1, 'team')) {
                    Log::error('Failed to place member in achievement_tree');
                    return false;
                }
                
                // Check achievement income eligibility after placement
                $this->checkAchievementIncomeAfterPlacement($memberId);
            }

            // For repurchase IDs - similar to regular but exclude achievement tree and global tree, use original_id for team filling
            if ($memberType === 'repurchase') {
                Log::info("🛒 Processing repurchase ID tree placements for: $memberId");
                
                // Enter Tree #1 of Team Tree Group (uses team filling starting from original_id)
                if (!$this->placeInTree('team_performance_tree', $memberId, $mlmPlan->original_id, 1, 'team')) {
                    Log::error('Failed to place repurchase member in team_performance_tree');
                    return false;
                }
                
                // NOTE: Repurchase IDs do NOT enter Global Tree or Achievement Tree
                Log::info("🚫 Skipping Global Tree and Achievement Tree for repurchase ID: $memberId");
            }

            // For global_tree_rebirth IDs - only enters global_tree
            if ($memberType === 'global_tree_rebirth') {
                Log::info("🌍 Processing global tree rebirth ID tree placements for: $memberId");
                
                // Enter Tree #1 of Global Tree Group (uses global filling)
                if (!$this->placeInTree('global_tree', $memberId, $sponsorId, 1, 'global')) {
                    Log::error('Failed to place global tree rebirth in global_tree');
                    return false;
                }
                
                // NOTE: Global tree rebirth IDs ONLY enter Global Tree
                Log::info("🚫 Global tree rebirth ID $memberId only enters global tree");
            }

            // Special handling for repurchase IDs - check if all_father_id is qualified for Fast Track
            // NOTE: Only place repurchase in Fast Track if all_father is ALREADY in Fast Track tree
            // If all_father is not in Fast Track yet, skip placement - it will be handled in qualification check
            if ($memberType === 'repurchase' && $mlmPlan->all_father_id) {
                $allFatherId = $mlmPlan->all_father_id;
                
                Log::info("🛒 Checking Fast Track status for repurchase $memberId with all_father_id: $allFatherId");
                
                // Simple check: Is the all_father already IN the Fast Track tree?
                $allFatherInFastTrack = fast_track_tree::where('memberid', $allFatherId)
                    ->where('tree_no', 1)
                    ->first();
                
                if ($allFatherInFastTrack) {
                    Log::info("🎯 All Father ID $allFatherId is already in Fast Track Tree #1 - placing repurchase $memberId normally");
                    
                    if (!$this->placeInTree('fast_track_tree', $memberId, $sponsorId, 1, 'global')) {
                        Log::error('Failed to place repurchase member in fast_track_tree');
                        return false;
                    } else {
                        Log::info("✅ Successfully placed repurchase $memberId in Fast Track Tree #1");
                    }
                } else {
                    Log::info("⏸️ All Father ID $allFatherId is not in Fast Track yet - skipping Fast Track placement for repurchase $memberId");
                    Log::info("📋 If this repurchase triggers qualification, it will be placed in the qualification check");
                }
            }

            // Special handling for rebirth IDs - check if original_id is qualified for Fast Track
            if ($memberType === 'rebirth' && $mlmPlan->original_id) {
                $originalId = $mlmPlan->original_id;
                
                Log::info("Checking Fast Track qualification for rebirth $memberId with original_id: $originalId");
                
                if ($this->isOriginalIdQualifiedForFastTrack($originalId)) {
                    Log::info("🎯 Original ID $originalId is qualified for Fast Track - placing rebirth $memberId in Fast Track Tree #1");
                    
                    if (!$this->placeInTree('fast_track_tree', $memberId, $sponsorId, 1, 'global')) {
                        Log::error('Failed to place rebirth member in fast_track_tree');
                        return false;
                    } else {
                        Log::info("✅ Successfully placed rebirth $memberId in Fast Track Tree #1");
                    }
                } else {
                    Log::info("Original ID $originalId is not qualified for Fast Track - rebirth $memberId will only be in standard trees");
                }
            }

            // Check if qualified for Fast Track (has 3 direct referrals)
            // if ($this->hasThreeDirectReferrals($memberId) && $memberType !== 'fast_track_rebirth') {
            //     // Enter Tree #1 of Fast Track Group (uses global filling)
            //     if (!$this->placeInTree('fast_track_tree', $memberId, $sponsorId, 1, 'global')) {
            //         Log::error('Failed to place member in fast_track_tree');
            //         return false;
            //     }
            // }

            return true;
            
        } catch (\Exception $e) {
            Log::error('Error in tree placements for member ' . $memberId . ': ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Place member in specific tree
     */
    public function placeInTree($treeModelName, $memberId, $sponsorId, $treeNo, $fillingMethod)
    {
        try {
            Log::info("Placing member $memberId in $treeModelName tree $treeNo using $fillingMethod filling");

            $model = $this->getModelInstance($treeModelName);
            if (!$model) {
                Log::error("Model not found: $treeModelName");
                return false;
            }

            // Check if this member is already a root node in any tree of this tree group
            if ($this->isRootNodeInTreeGroup($memberId, $treeModelName)) {
                Log::info("Member $memberId is already a root node in $treeModelName group - skipping placement in tree $treeNo");
                return true; // Return true as this is not an error, just a skip
            }

            // Check if member already exists in this specific tree
            if ($this->memberExistsInTree($memberId, $treeModelName, $treeNo)) {
                Log::info("Member $memberId already exists in $treeModelName tree $treeNo - skipping placement");
                return true; // Return true as this is not an error, just a skip
            }

            $placementData = $this->findPlacement($treeModelName, $sponsorId, $fillingMethod, $treeNo);
            
            if (!$placementData) {
                Log::error("Could not find placement for member $memberId in $treeModelName");
                return false;
            }

            // Create new tree entry only if not root position (root nodes are manually added)
            if ($placementData['nextPos'] !== 'root') {
                $treeEntry = new $model();
                $treeEntry->memberid = $memberId;
                $treeEntry->placement_id = $placementData['parentId'];
                $treeEntry->pos = $placementData['nextPos'];
                $treeEntry->tree_no = $treeNo;
                $treeEntry->save();

                Log::info("Successfully placed member $memberId in $treeModelName tree $treeNo at position {$placementData['nextPos']} under parent {$placementData['parentId']}");
            } else {
                Log::info("Skipping root placement for member $memberId in $treeModelName tree $treeNo - root nodes are manually managed");
            }

            // Generate income based on tree placement
            $this->generateIncomeForPlacement($memberId, $treeModelName, $treeNo);

            // Check for tree progression - both for the new member and affected parents
            $this->checkTreeProgressionAfterPlacement($memberId, $treeModelName, $treeNo, $placementData['parentId']);

            return true;

        } catch (\Exception $e) {
            Log::error("Error placing member $memberId in $treeModelName: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Find placement based on filling method
     */
    protected function findPlacement($treeModelName, $sponsorId, $fillingMethod, $treeNo)
    {
        if ($fillingMethod === 'global') {
            return $this->findGlobalPlacement($treeModelName, $treeNo);
        } else {
            return $this->findTeamPlacement($treeModelName, $sponsorId, $treeNo);
        }
    }

    /**
     * Find placement using global filling (breadth-first from root)
     */
    protected function findGlobalPlacement($treeModelName, $treeNo)
    {
        return $this->treeTraversalController->findGlobalPlacement($treeModelName, $treeNo);
    }

    /**
     * Find placement using team filling (starting from sponsor)
     */
    protected function findTeamPlacement($treeModelName, $sponsorId, $treeNo)
    {
        // For team_performance_tree, we need special handling to find existing sponsor in the tree
        if ($treeModelName === 'team_performance_tree') {
            return $this->findTeamPlacementWithSponsorHierarchy($treeModelName, $sponsorId, $treeNo);
        }
        
        return $this->treeTraversalController->findTeamPlacement($sponsorId, $treeModelName, $treeNo);
    }

    /**
     * Find team placement with sponsor hierarchy search for team_performance_tree
     */
    protected function findTeamPlacementWithSponsorHierarchy($treeModelName, $sponsorId, $treeNo)
    {
        $model = $this->getModelInstance($treeModelName);
        if (!$model) {
            return ['error' => 'Invalid model name.'];
        }

        $currentSponsorId = $sponsorId;
        $maxLevelsUp = 10; // Prevent infinite loops
        $levelsChecked = 0;

        Log::info("Searching for existing sponsor in $treeModelName tree $treeNo starting with sponsor: $currentSponsorId");

        // Search up the sponsor hierarchy to find one that exists in this tree
        while ($currentSponsorId && $levelsChecked < $maxLevelsUp) {
            // Check if current sponsor exists in this tree
            $sponsorInTree = $model::where('memberid', $currentSponsorId)
                ->where('tree_no', $treeNo)
                ->first();

            if ($sponsorInTree) {
                Log::info("Found existing sponsor $currentSponsorId in $treeModelName tree $treeNo");
                return $this->treeTraversalController->findPlacementAndPosition($currentSponsorId, $treeModelName, $treeNo);
            }

            // Move up to the next sponsor in hierarchy
            $mlmPlan = mlm_plan::where('memberid', $currentSponsorId)->first();
            if (!$mlmPlan || !$mlmPlan->sponsor_id) {
                break; // Reached top of hierarchy
            }

            $currentSponsorId = $mlmPlan->sponsor_id;
            $levelsChecked++;
            
            Log::info("Sponsor not found in tree, moving up to sponsor: $currentSponsorId (level $levelsChecked)");
        }

        // If no sponsor found in hierarchy, start from root of the tree
        Log::info("No sponsor found in hierarchy for $treeModelName tree $treeNo, using root placement");
        
        // Look for manually added root node (placement_id is null)
        $rootMember = $model::where('tree_no', $treeNo)
            ->whereNull('placement_id')
            ->first();
        
        if (!$rootMember) {
            // No manually added root found - this should not happen
            Log::warning("No root node found in $treeModelName tree $treeNo - this may indicate missing manual root setup");
            return ['parentId' => null, 'nextPos' => 'root'];
        }

        // Use breadth-first search starting from manually added root
        return $this->treeTraversalController->findPlacementAndPosition($rootMember->memberid, $treeModelName, $treeNo);
    }

    /**
     * Check if member has 3 direct referrals
     */
    protected function hasThreeDirectReferrals($memberId)
    {
        $count = mlm_plan::where('sponsor_id', $memberId)
        ->where('memberid_type', 'regular')
        ->where('status', 1)->count();

        Log::info("Member $memberId has $count direct referrals");
        return $count >= 3;
    }

    /**
     * Check if member has 3 repurchase IDs
     */
    protected function hasThreeRepurchaseIds($memberId)
    {
        $count = mlm_plan::where('all_father_id', $memberId)
            ->where('memberid_type', 'repurchase')
            ->where('status', 1)
            ->count();

        Log::info("Member $memberId has $count repurchase IDs");
        return $count >= 3;
    }

    /**
     * Generate income for tree placement
     */
    protected function generateIncomeForPlacement($memberId, $treeModelName, $treeNo)
    {
        try {
            switch ($treeModelName) {
                case 'team_performance_tree':
                    // For team performance, we need the parent who received the new child
                    $parentId = $this->getParentIdFromTreeEntry($memberId, $treeModelName, $treeNo);
                    if ($parentId) {
                        $this->incomeController->generateTeamPerformanceIncome($memberId, $parentId, $treeNo);
                    } else {
                        Log::info("No parent found for $memberId in $treeModelName tree $treeNo - no income to generate");
                    }
                    break;
                    
                case 'global_tree':
                    // For global bonus, we also need the parent who received the new child
                    $parentId = $this->getParentIdFromTreeEntry($memberId, $treeModelName, $treeNo);
                    if ($parentId) {
                        $this->incomeController->generateGlobalBonusIncome($memberId, $parentId, $treeNo);
                    } else {
                        Log::info("No parent found for $memberId in $treeModelName tree $treeNo - no income to generate");
                    }
                    break;
                    
                case 'fast_track_tree':
                    // Fast track income is generated when member gets 3 direct children, not on placement
                    break;
                    
                default:
                    // No income for achievement_tree placements
                    break;
            }
            
        } catch (\Exception $e) {
            Log::error("Error generating income for placement: " . $e->getMessage());
        }
    }

    /**
     * Get parent ID from tree entry
     */
    protected function getParentIdFromTreeEntry($memberId, $treeModelName, $treeNo)
    {
        try {
            $model = $this->getModelInstance($treeModelName);
            if (!$model) {
                return null;
            }

            $entry = $model::where('memberid', $memberId)
                ->where('tree_no', $treeNo)
                ->first();

            return $entry ? $entry->placement_id : null;

        } catch (\Exception $e) {
            Log::error("Error getting parent ID for member $memberId: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Check for tree progression after a new placement
     * This checks both the newly placed member AND the parent who received the new child
     */
    protected function checkTreeProgressionAfterPlacement($newlyPlacedMemberId, $treeModelName, $currentTreeNo, $parentId)
    {
        Log::info("Checking tree progression after placing $newlyPlacedMemberId under parent $parentId in $treeModelName tree $currentTreeNo");
        
        // 1. Check if the newly placed member has 3 direct children (original logic)
        $this->checkMemberTreeProgression($newlyPlacedMemberId, $treeModelName, $currentTreeNo);
        
        // 2. Check if the parent now has 3 direct children due to this new placement
        if ($parentId && $parentId !== 'root') {
            Log::info("Checking if parent $parentId now has 3 children due to new placement");
            $this->checkMemberTreeProgression($parentId, $treeModelName, $currentTreeNo);
        }
        
        // 3. For additional safety, check if any other member in the affected path needs progression
        // This could happen in complex tree scenarios
        // Skip for Fast Track (uses global filling, no complex scenarios)
        // if ($treeModelName !== 'fast_track_tree' ) {
        //    $this->checkAffectedMembersProgression($newlyPlacedMemberId, $treeModelName, $currentTreeNo);
        // } else {
        //     Log::info("Skipping affected members progression check for Fast Track tree (global filling used)");
        // }
    }

    /**
     * Check tree progression for a specific member
     */
    protected function checkMemberTreeProgression($memberId, $treeModelName, $currentTreeNo)
    {
        // Check if member has 3 direct children in current tree
        if ($this->hasThreeDirectChildrenInTree($memberId, $treeModelName, $currentTreeNo)) {
            
            Log::info("🎯 Member $memberId has 3 direct children in $treeModelName tree $currentTreeNo - triggering progression");
            
            // Handle tree progression based on tree type
            switch ($treeModelName) {
                case 'team_performance_tree':
                    if ($currentTreeNo < 15) {
                        $this->progressToNextTree($memberId, $treeModelName, $currentTreeNo + 1);
                    }
                    break;
                    
                case 'global_tree':
                    // Generate global tree rebirth when member gets 3 direct children
                    $this->generateGlobalTreeRebirth($memberId);
                    break;
                    
                case 'fast_track_tree':
                    if ($currentTreeNo == 1) {
                        $this->progressToNextTree($memberId, $treeModelName, 2);
                    } else if ($currentTreeNo == 2) {
                        // Generate fast track local rebirth
                        $this->generateFastTrackRebirth($memberId);
                    }
                    
                    // Generate Fast Track income when member gets 3 direct children
                    $this->incomeController->generateFastTrackIncome($memberId, $currentTreeNo);
                    break;
            }
        } else {
            Log::info("Member $memberId has less than 3 children in $treeModelName tree $currentTreeNo - no progression needed");
        }
    }

    /**
     * Check if any other members in the affected tree path need progression
     */
    protected function checkAffectedMembersProgression($newlyPlacedMemberId, $treeModelName, $currentTreeNo)
    {
        try {
            // This is an additional safety check for complex scenarios
            // In most cases, checking the newly placed member and their parent should be sufficient
            
            Log::info("Running additional progression checks for affected members in $treeModelName tree $currentTreeNo");
            
            // Get the tree entry for the newly placed member
            $model = $this->getModelInstance($treeModelName);
            if (!$model) {
                return;
            }
            
            $newEntry = $model::where('memberid', $newlyPlacedMemberId)
                ->where('tree_no', $currentTreeNo)
                ->first();
                
            if (!$newEntry) {
                return;
            }
            
            // Get all members in the same tree that might be affected
            // CRITICAL FIX: Reduced time window from 5 minutes to 30 seconds to prevent exponential checks
            $recentPlacements = $model::where('tree_no', $currentTreeNo)
                ->where('created_at', '>=', now()->subSeconds(30)) // Shorter window to prevent exponential multiplication
                ->pluck('memberid')
                ->unique();
                
            // SAFETY LIMIT: Max 5 additional checks to prevent cascade effects
            $checkCount = 0;
            $maxChecks = 5;
                
            foreach ($recentPlacements as $recentMemberId) {
                if ($recentMemberId != $newlyPlacedMemberId && $checkCount < $maxChecks) {
                    // Check if this member now qualifies for progression
                    $this->checkMemberTreeProgression($recentMemberId, $treeModelName, $currentTreeNo);
                    $checkCount++;
                } elseif ($checkCount >= $maxChecks) {
                    Log::info("⚠️ Reached maximum additional progression checks ($maxChecks) - stopping to prevent cascade");
                    break;
                }
            }
            
        } catch (\Exception $e) {
            Log::error("Error in checkAffectedMembersProgression: " . $e->getMessage());
            // Don't fail the entire process for this additional check
        }
    }

    /**
     * Check if member has 3 direct children in specific tree
     */
    protected function hasThreeDirectChildrenInTree($memberId, $treeModelName, $treeNo)
    {
        $count = $this->treeTraversalController->countDirectChildren($memberId, $treeModelName, $treeNo);
        return $count >= 3;
    }

    /**
     * Progress member to next tree in same group
     */
    protected function progressToNextTree($memberId, $treeModelName, $nextTreeNo)
    {
        Log::info("Progressing member $memberId to tree $nextTreeNo in $treeModelName");
        
        // Additional safety check - don't progress root nodes to other trees
        if ($this->isRootNodeInTreeGroup($memberId, $treeModelName)) {
            Log::info("Member $memberId is a root node in $treeModelName group - skipping progression to tree $nextTreeNo");
            return;
        }

        // Check if member already exists in the target tree
        if ($this->memberExistsInTree($memberId, $treeModelName, $nextTreeNo)) {
            Log::info("Member $memberId already exists in $treeModelName tree $nextTreeNo - skipping progression");
            return;
        }
        
        $mlmPlan = mlm_plan::where('memberid', $memberId)->first();
        if ($mlmPlan) {
            $fillingMethod = in_array($treeModelName, ['global_tree', 'fast_track_tree']) ? 'global' : 'team';
            
            // For team_performance_tree progression, use the member's original sponsor
            // The findTeamPlacement method will handle the sponsor hierarchy search
            $sponsorToUse = $mlmPlan->sponsor_id;
            
            Log::info("Attempting to place member $memberId in $treeModelName tree $nextTreeNo with $fillingMethod filling");
            $success = $this->placeInTree($treeModelName, $memberId, $sponsorToUse, $nextTreeNo, $fillingMethod);
            
            if ($success) {
                Log::info("✅ Successfully progressed member $memberId to $treeModelName tree $nextTreeNo");
            } else {
                Log::error("❌ Failed to progress member $memberId to $treeModelName tree $nextTreeNo");
            }
        } else {
            Log::error("MLM plan not found for member $memberId - cannot progress to next tree");
        }
    }

    /**
     * Generate rebirth ID from global tree completion
     */
    protected function generateGlobalRebirth($originalMemberId)
    {

        Log::info("Generating global rebirth for member: $originalMemberId");

        $rebirthId = $this->generateUniqueId();
        $rebirthId="RB" . $rebirthId; // Prefix for rebirth IDs
        
        // Create rebirth entry in mlm_plan
        $originalPlan = mlm_plan::where('memberid', $originalMemberId)->first();
        $rebirthPlan = new mlm_plan();
        $rebirthPlan->memberid = $rebirthId;
        $rebirthPlan->sponsor_id = $originalPlan->sponsor_id;
        $rebirthPlan->placement_id = $originalPlan->placement_id;
        $rebirthPlan->referral_count = 0;
        $rebirthPlan->memberid_type = 'rebirth';
        $rebirthPlan->original_id = $originalPlan->original_id ?? $originalMemberId; // Track original root ID
        $rebirthPlan->status = 0; // Automatically activated
        $rebirthPlan->save();

        // Add to activation queue for processing
        $activationQueue = new plan_activation_queue();
        $activationQueue->login_id = $originalMemberId;
        $activationQueue->activation_id = $rebirthId;
        $activationQueue->activation_status = 'pending';
        $activationQueue->status = 'success';
        $activationQueue->save();

        // Generate Reignite Income for the original_id
        $this->incomeController->generateReigniteIncome($rebirthId, $originalPlan->original_id ?? $originalMemberId);

        // Check if original_id is qualified for Fast Track and place rebirth there
        $rootOriginalId = $originalPlan->original_id ?? $originalMemberId;
        
        Log::info("🔍 Checking Fast Track qualification for rebirth $rebirthId with root original_id: $rootOriginalId");
        
        if ($this->isOriginalIdQualifiedForFastTrack($rootOriginalId)) {
            Log::info("🎉 Root original ID $rootOriginalId is qualified for Fast Track!");
            Log::info("📋 Rebirth $rebirthId will be automatically placed in Fast Track during activation process");
        } else {
            Log::info("⏳ Root original ID $rootOriginalId is not yet qualified for Fast Track");
            Log::info("📋 Rebirth $rebirthId will only enter standard trees (Team, Global, Achievement)");
        }
    }

    /**
     * Generate fast track local rebirth
     */
    protected function generateFastTrackRebirth($originalMemberId)
    {
        Log::info("Generating fast track rebirth for member: $originalMemberId");

        // Generate 2 rebirth IDs for fast track
        for ($i = 0; $i < 2; $i++) {
            $rebirthId = $this->generateUniqueId();
            $rebirthId="FT" . $rebirthId;

            $originalPlan = mlm_plan::where('memberid', $originalMemberId)->first();
            
            // Find the root Fast Track patriarch by traversing up the chain
            $allFatherId = $this->treeTraversalController->findFastTrackRootPatriarch($originalMemberId);
            
            Log::info("Creating fast track rebirth $rebirthId with root all_father_id: $allFatherId (traced from $originalMemberId)");
            
            $rebirthPlan = new mlm_plan();
            $rebirthPlan->memberid = $rebirthId;
            $rebirthPlan->sponsor_id = $originalPlan->sponsor_id;
            $rebirthPlan->placement_id = $originalPlan->placement_id;
            $rebirthPlan->referral_count = 0;
            $rebirthPlan->memberid_type = 'fast_track_rebirth';
            $rebirthPlan->original_id = $originalPlan->original_id ?? $originalMemberId; // Track original root ID
            $rebirthPlan->all_father_id = $allFatherId; // Track the Fast Track patriarch
            $rebirthPlan->status = 1;
            $rebirthPlan->save();

            // Place directly in Fast Track Tree #1
            $this->placeInTree('fast_track_tree', $rebirthId, $originalPlan->sponsor_id, 1, 'global');
        }
    }

    /**
     * Generate global tree rebirth from getting 3 direct children
     */
    protected function generateGlobalTreeRebirth($originalMemberId)
    {
        Log::info("Generating global tree rebirth for member: $originalMemberId");

        // CRITICAL FIX: Check if a GR rebirth already exists for this member to prevent duplicates
        $existingRebirth = plan_activation_queue::where('login_id', $originalMemberId)
            ->where('activation_id', 'like', 'GR%')
            ->where('activation_status', '!=', 'failed')
            ->first();
        
        if ($existingRebirth) {
            Log::info("🚫 Global tree rebirth already exists for member $originalMemberId - skipping duplicate creation");
            return;
        }

         $originalPlan = mlm_plan::where('memberid', $originalMemberId)->first();

        $rebirthId = $this->generateUniqueId();
        $rebirthId = "GR" . $rebirthId; // Prefix for global tree rebirth IDs
        
        // Create rebirth entry in mlm_plan
        $originalPlan = mlm_plan::where('memberid', $originalMemberId)->first();
        $rebirthPlan = new mlm_plan();
        $rebirthPlan->memberid = $rebirthId;
        $rebirthPlan->sponsor_id = $originalPlan->sponsor_id;
        $rebirthPlan->placement_id = $originalPlan->placement_id;
        $rebirthPlan->referral_count = 0;
        $rebirthPlan->FullName = $originalPlan->FullName;
        $rebirthPlan->memberid_type = 'global_tree_rebirth';
        $rebirthPlan->original_id = $originalPlan->original_id ?? $originalMemberId; // Track original root ID
        $rebirthPlan->all_father_id = $originalPlan->all_father_id ?? $originalMemberId; // Track the global tree patriarch
        $rebirthPlan->status = 0; // Pending activation
        $rebirthPlan->save();

        // Add to activation queue for processing
        $activationQueue = new plan_activation_queue();
        $activationQueue->login_id = $originalMemberId;
        $activationQueue->activation_id = $rebirthId;
        $activationQueue->parent_activation_id = $this->getCurrentProcessingActivationId($originalMemberId);
        $activationQueue->activation_status = 'pending';
        $activationQueue->status = 'success';
        $activationQueue->save();

        Log::info("✅ Successfully created global tree rebirth $rebirthId and added to activation queue");
    }

    /**
     * Get the current processing activation ID for parent_activation_id relationship
     */
    protected function getCurrentProcessingActivationId($originalMemberId)
    {
        // Find the currently processing activation record for this member
        $currentProcessing = plan_activation_queue::where('activation_status', 'processing')
            ->where(function($query) use ($originalMemberId) {
                $query->where('activation_id', $originalMemberId)
                      ->orWhere('login_id', $originalMemberId);
            })
            ->orderBy('id', 'desc')
            ->first();

        return $currentProcessing ? $currentProcessing->id : null;
    }

    /**
     * Generate IGNITE bonus for referrer
     */
    protected function generateIgniteBonus($referrerId, $newMemberId)
    {
        if (!$referrerId) return;

        Log::info("Generating IGNITE bonus for referrer: $referrerId from new member: $newMemberId");
        
        // Generate IGNITE bonus (₹160) for the referrer
        // $this->incomeController->generateReigniteIncome($newMemberId, $referrerId);

          $referral_income = new referral_income();
        $referral_income->memberid = $referrerId;
        $referral_income->fromId = $newMemberId;
        $referral_income->payout = 160;
        $referral_income->netpay = 160;
        $referral_income->save();

    }

    /**
     * Generate unique member ID
     */
    protected function generateUniqueId()
    {
        do {
            $id = mt_rand(10000000, 99999999);
        } while (mlm_plan::where('memberid', $id)->exists());
        
        return $id;
    }

    /**
     * Check if sponsor now qualifies for Fast Track after new referral activation
     */
    protected function checkSponsorFastTrackQualification($newlyActivatedMemberId)
    {
        try {
            // 1. Get the newly activated member's details
            $newMember = mlm_plan::where('memberid', $newlyActivatedMemberId)->first();
            if (!$newMember || !$newMember->sponsor_id) {
                Log::info("No sponsor to check for Fast Track qualification for member: $newlyActivatedMemberId");
                return; // No sponsor to check
            }

            $sponsorId = $newMember->sponsor_id;
            Log::info("Checking Fast Track qualification for sponsor: $sponsorId after activating referral: $newlyActivatedMemberId");
            
            // 2. Verify sponsor is activated
            $sponsor = mlm_plan::where('memberid', $sponsorId)->first();
            if (!$sponsor || $sponsor->status != 1) {
                Log::info("Sponsor $sponsorId is not activated yet, skipping Fast Track check");
                return; // Sponsor not activated yet
            }

            // 3. Check if sponsor now has 3 referrals OR 3 repurchase IDs
            $hasThreeReferrals = $this->hasThreeDirectReferrals($sponsorId);
            $hasThreeRepurchases = $this->hasThreeRepurchaseIds($sponsorId);
            
            if (!$hasThreeReferrals && !$hasThreeRepurchases) {
                Log::info("Sponsor $sponsorId does not have 3 referrals OR 3 repurchases yet, skipping Fast Track");
                return; // Sponsor doesn't qualify yet
            }
            
            if ($hasThreeReferrals) {
                Log::info("Sponsor $sponsorId qualifies for Fast Track via 3 referrals");
            }
            if ($hasThreeRepurchases) {
                Log::info("Sponsor $sponsorId qualifies for Fast Track via 3 repurchase IDs");
            }

            // 4. Check if sponsor is already in Fast Track
            $existingFastTrack = fast_track_tree::where('memberid', $sponsorId)
                ->where('tree_no', 1)
                ->first();
            
            if ($existingFastTrack) {
                Log::info("Sponsor $sponsorId is already in Fast Track Tree #1");
                return; // Already in Fast Track
            }

            // 5. Check sponsor type (exclude fast_track_rebirth)
            if ($sponsor->memberid_type === 'fast_track_rebirth') {
                Log::info("Sponsor $sponsorId is fast_track_rebirth, excluding from Fast Track entry");
                return; // Fast track rebirths don't re-enter
            }

            // 6. Place sponsor in Fast Track Tree #1
            Log::info("🎉 Sponsor $sponsorId now qualifies for Fast Track due to activation of $newlyActivatedMemberId");
            Log::info("🔄 Step 1: Placing qualified sponsor $sponsorId in Fast Track Tree #1");
            
            $success = $this->placeInTree('fast_track_tree', $sponsorId, $sponsor->sponsor_id, 1, 'global');
            
            if ($success) {
                Log::info("✅ Successfully placed sponsor $sponsorId in Fast Track Tree #1");
                
                // Step 2: Place any existing global rebirths of this sponsor in Fast Track
                Log::info("🔄 Step 2: Processing existing rebirth IDs for sponsor $sponsorId");
                $this->placeExistingGlobalRebirthsInFastTrack($sponsorId);
                
                // Step 3: Place any existing repurchases of this sponsor in Fast Track  
                Log::info("🔄 Step 3: Processing existing repurchase IDs for sponsor $sponsorId");
                $this->placeExistingRepurchasesInFastTrack($sponsorId);
                
            } else {
                Log::error("❌ Failed to place sponsor $sponsorId in Fast Track Tree #1");
                Log::info("⏸️ Skipping rebirth and repurchase processing due to sponsor placement failure");
            }

        } catch (\Exception $e) {
            Log::error("Error checking sponsor Fast Track qualification: " . $e->getMessage());
        }
    }

    /**
     * Check if all_father_id now qualifies for Fast Track after repurchase activation
     */
    protected function checkAllFatherFastTrackQualification($allFatherId, $newlyActivatedRepurchaseId)
    {
        try {
            Log::info("Checking Fast Track qualification for all_father_id: $allFatherId after activating repurchase: $newlyActivatedRepurchaseId");
            
            // 1. Verify all_father exists and is activated
            $allFather = mlm_plan::where('memberid', $allFatherId)->first();
            if (!$allFather || $allFather->status != 1) {
                Log::info("All Father $allFatherId is not activated yet, skipping Fast Track check");
                return; // All father not activated yet
            }

            // 2. Check if all_father now has 3 repurchase IDs (or already had 3 referrals)
            $hasThreeReferrals = $this->hasThreeDirectReferrals($allFatherId);
            $hasThreeRepurchases = $this->hasThreeRepurchaseIds($allFatherId);
            
            if (!$hasThreeReferrals && !$hasThreeRepurchases) {
                Log::info("All Father $allFatherId does not have 3 referrals OR 3 repurchases yet, skipping Fast Track");
                return; // All father doesn't qualify yet
            }

            // 3. Check if all_father is already in Fast Track
            $existingFastTrack = fast_track_tree::where('memberid', $allFatherId)
                ->where('tree_no', 1)
                ->first();
            
            if ($existingFastTrack) {
                Log::info("All Father $allFatherId is already in Fast Track Tree #1");
                return; // Already in Fast Track
            }

            // 4. Check all_father type (exclude fast_track_rebirth)
            if ($allFather->memberid_type === 'fast_track_rebirth') {
                Log::info("All Father $allFatherId is fast_track_rebirth, excluding from Fast Track entry");
                return; // Fast track rebirths don't re-enter
            }

            // 5. Place all_father in Fast Track Tree #1
            if ($hasThreeReferrals) {
                Log::info("🎉 All Father $allFatherId qualifies for Fast Track via 3 referrals");
            }
            if ($hasThreeRepurchases) {
                Log::info("🎉 All Father $allFatherId qualifies for Fast Track via 3 repurchase IDs due to activation of $newlyActivatedRepurchaseId");
            }
            
            Log::info("🔄 Step 1: Placing qualified all_father $allFatherId in Fast Track Tree #1 FIRST");
            $success = $this->placeInTree('fast_track_tree', $allFatherId, $allFather->sponsor_id, 1, 'global');
            
            if ($success) {
                Log::info("✅ Successfully placed all_father $allFatherId in Fast Track Tree #1");
                
                // Step 2: Place any existing global rebirths of this all_father in Fast Track
                Log::info("🔄 Step 2: Processing existing rebirth IDs for all_father $allFatherId");
                $this->placeExistingGlobalRebirthsInFastTrack($allFatherId);
                
                // Step 3: Place ALL repurchases in chronological order (including the triggering one)
                Log::info("🔄 Step 3: Processing ALL repurchase IDs for all_father $allFatherId in chronological order");
                $this->placeExistingRepurchasesInFastTrack($allFatherId);
                
            } else {
                Log::error("❌ Failed to place all_father $allFatherId in Fast Track Tree #1");
                Log::info("⏸️ Skipping rebirth and repurchase processing due to all_father placement failure");
            }

        } catch (\Exception $e) {
            Log::error("Error checking all_father Fast Track qualification: " . $e->getMessage());
        }
    }

    /**
     * Place existing global rebirths in Fast Track when original member qualifies
     */
    protected function placeExistingGlobalRebirthsInFastTrack($originalMemberId)
    {
        try {
            Log::info("Checking for existing global rebirths to place in Fast Track for original member: $originalMemberId");

            // Find all global rebirths linked to this member (both direct and through rebirth chain)
            $globalRebirths = mlm_plan::where(function($query) use ($originalMemberId) {
                $query->where('original_id', $originalMemberId)
                      ->orWhere('original_id', function($subQuery) use ($originalMemberId) {
                          $subQuery->select('original_id')
                                   ->from('mlm_plan')
                                   ->where('memberid', $originalMemberId)
                                   ->whereNotNull('original_id');
                      });
            })
            ->where('memberid_type', 'rebirth')
            ->where('status', 1) // Only activated rebirths
            ->get();

            // Also check if the original member itself is a rebirth and get all rebirths from the root
            $originalMember = mlm_plan::where('memberid', $originalMemberId)->first();
            if ($originalMember && $originalMember->original_id) {
                // This member is a rebirth, get all rebirths from the same root
                $rootId = $originalMember->original_id;
                $allRebirths = mlm_plan::where('original_id', $rootId)
                    ->where('memberid_type', 'rebirth')
                    ->where('status', 1)
                    ->get();
                
                $globalRebirths = $globalRebirths->merge($allRebirths)->unique('memberid');
            }

            if ($globalRebirths->isEmpty()) {
                Log::info("No existing global rebirths found for member: $originalMemberId");
                return;
            }

            Log::info("Found " . $globalRebirths->count() . " global rebirths to process for Fast Track entry");

            foreach ($globalRebirths as $rebirth) {
                // Check if already in Fast Track
                $existingFastTrack = fast_track_tree::where('memberid', $rebirth->memberid)
                    ->where('tree_no', 1)
                    ->first();
                    
                if ($existingFastTrack) {
                    Log::info("Rebirth {$rebirth->memberid} is already in Fast Track Tree #1");
                    continue;
                }

                // Place rebirth in Fast Track Tree #1
                Log::info("🎯 Placing existing global rebirth {$rebirth->memberid} in Fast Track Tree #1");
                
                $success = $this->placeInTree('fast_track_tree', $rebirth->memberid, $rebirth->sponsor_id, 1, 'global');
                
                if ($success) {
                    Log::info("✅ Successfully placed rebirth {$rebirth->memberid} in Fast Track Tree #1");
                } else {
                    Log::error("❌ Failed to place rebirth {$rebirth->memberid} in Fast Track Tree #1");
                }
            }

        } catch (\Exception $e) {
            Log::error("Error placing existing global rebirths in Fast Track: " . $e->getMessage());
        }
    }

    /**
     * Place existing repurchase IDs in Fast Track when all_father qualifies
     */
    protected function placeExistingRepurchasesInFastTrack($allFatherId)
    {
        try {
            Log::info("Checking for existing repurchases to place in Fast Track for all_father: $allFatherId");

            // Find all repurchase IDs linked to this all_father in chronological order
            $repurchases = mlm_plan::where('all_father_id', $allFatherId)
                ->where('memberid_type', 'repurchase')
                ->where('status', 1) // Only activated repurchases
                ->orderBy('created_at', 'asc') // Chronological order: 1st, 2nd, 3rd, etc.
                ->get();

            if ($repurchases->isEmpty()) {
                Log::info("No existing repurchases found for all_father: $allFatherId");
                return;
            }

            Log::info("Found " . $repurchases->count() . " repurchases to process for Fast Track entry in chronological order");

            foreach ($repurchases as $index => $repurchase) {
                $orderNumber = $index + 1;
                
                // Check if already in Fast Track
                $existingFastTrack = fast_track_tree::where('memberid', $repurchase->memberid)
                    ->where('tree_no', 1)
                    ->first();
                    
                if ($existingFastTrack) {
                    Log::info("Repurchase {$repurchase->memberid} (#{$orderNumber}) is already in Fast Track Tree #1");
                    continue;
                }

                // Place repurchase in Fast Track Tree #1
                Log::info("🛒 Placing repurchase {$repurchase->memberid} (#{$orderNumber}) in Fast Track Tree #1");
                
                $success = $this->placeInTree('fast_track_tree', $repurchase->memberid, $repurchase->sponsor_id, 1, 'global');
                
                if ($success) {
                    Log::info("✅ Successfully placed repurchase {$repurchase->memberid} (#{$orderNumber}) in Fast Track Tree #1");
                } else {
                    Log::error("❌ Failed to place repurchase {$repurchase->memberid} (#{$orderNumber}) in Fast Track Tree #1");
                }
            }

        } catch (\Exception $e) {
            Log::error("Error placing existing repurchases in Fast Track: " . $e->getMessage());
        }
    }

    /**
     * Check if a member is already a root node in any tree of the specified tree group
     * Root nodes are manually added and should not be placed again
     */
    protected function isRootNodeInTreeGroup($memberId, $treeModelName)
    {
        try {
            $model = $this->getModelInstance($treeModelName);
            if (!$model) {
                return false;
            }

            // Check if member exists as a root node (placement_id is null) in any tree of this group
            $rootEntry = $model::where('memberid', $memberId)
                ->whereNull('placement_id')
                ->first();

            if ($rootEntry) {
                Log::info("Member $memberId found as root node in $treeModelName tree {$rootEntry->tree_no}");
                return true;
            }

            return false;

        } catch (\Exception $e) {
            Log::error("Error checking root node status for member $memberId in $treeModelName: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Check if a member already exists in a specific tree
     */
    protected function memberExistsInTree($memberId, $treeModelName, $treeNo)
    {
        try {
            $model = $this->getModelInstance($treeModelName);
            if (!$model) {
                return false;
            }

            $existingEntry = $model::where('memberid', $memberId)
                ->where('tree_no', $treeNo)
                ->first();

            return $existingEntry !== null;

        } catch (\Exception $e) {
            Log::error("Error checking member existence in tree: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Check if original ID is qualified for Fast Track
     */
    protected function isOriginalIdQualifiedForFastTrack($originalId, $excludeRepurchaseId = null)
    {
        try {
            // Method 1: Check if the original ID exists in fast_track_tree
            $fastTrackEntry = fast_track_tree::where('memberid', $originalId)->first();
            
            if ($fastTrackEntry) {
                Log::info("Original ID $originalId found in Fast Track tree - QUALIFIED");
                return true;
            }

            // Method 2: Check if any of its rebirths are in Fast Track (which would indicate qualification)
            $rebirthInFastTrack = fast_track_tree::whereIn('memberid', function($query) use ($originalId) {
                $query->select('memberid')
                      ->from('mlm_plan')
                      ->where('original_id', $originalId)
                      ->where('memberid_type', 'rebirth');
            })->first();

            if ($rebirthInFastTrack) {
                Log::info("Original ID $originalId has rebirths in Fast Track - QUALIFIED");
                return true;
            }

            // Method 3: Check if original ID has 3+ direct referrals OR 3+ repurchase IDs (would qualify for Fast Track)
            $originalMember = mlm_plan::where('memberid', $originalId)->first();
            if ($originalMember) {
                $activeReferrals = mlm_plan::where('sponsor_id', $originalId)
                    ->where('status', 1)
                    ->count();
                
                $repurchaseQuery = mlm_plan::where('all_father_id', $originalId)
                    ->where('memberid_type', 'repurchase')
                    ->where('status', 1);
                
                // Exclude the currently processing repurchase if specified
                if ($excludeRepurchaseId) {
                    $repurchaseQuery->where('memberid', '!=', $excludeRepurchaseId);
                    Log::info("Excluding currently processing repurchase $excludeRepurchaseId from qualification check");
                }
                
                $repurchaseCount = $repurchaseQuery->count();
                
                if ($activeReferrals >= 3) {
                    Log::info("Original ID $originalId has $activeReferrals referrals (>=3) - QUALIFIED for Fast Track");
                    return true;
                } else if ($repurchaseCount >= 3) {
                    Log::info("Original ID $originalId has $repurchaseCount repurchase IDs (>=3) - QUALIFIED for Fast Track" . ($excludeRepurchaseId ? " (excluding $excludeRepurchaseId)" : ""));
                    return true;
                } else {
                    Log::info("Original ID $originalId has only $activeReferrals referrals and $repurchaseCount repurchases (<3 each) - NOT QUALIFIED" . ($excludeRepurchaseId ? " (excluding $excludeRepurchaseId)" : ""));
                }
            }

            Log::info("Original ID $originalId is not qualified for Fast Track");
            return false;

        } catch (\Exception $e) {
            Log::error("Error checking Fast Track qualification for original ID $originalId: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get model instance
     */
    protected function getModelInstance($modelName)
    {
        $modelClass = "App\\Models\\$modelName";
        
        if (class_exists($modelClass)) {
            return app($modelClass);
        }
        
        return null;
    }

    /**
     * Check achievement income eligibility after achievement tree placement
     * This will check all members in the tree hierarchy who might now be eligible
     */
    protected function checkAchievementIncomeAfterPlacement($newlyPlacedMemberId)
    {
        try {
            Log::info("🏆 Checking achievement income eligibility after placing member: $newlyPlacedMemberId");
            
            // Get all members in the upward hierarchy who might now be eligible
            $membersToCheck = $this->getAchievementTreeUpwardHierarchy($newlyPlacedMemberId);
            
            // Check each member in the hierarchy for eligibility using IncomeController
            foreach ($membersToCheck as $memberId) {
                $this->incomeController->checkAchievementIncomeEligibility($memberId);
            }
            
        } catch (\Exception $e) {
            Log::error("Error checking achievement income after placement: " . $e->getMessage());
        }
    }

    /**
     * Get upward hierarchy in achievement tree to check for eligibility
     * When a new member is placed, all their ancestors might become eligible
     */
    protected function getAchievementTreeUpwardHierarchy($memberId)
    {
        try {
            $membersToCheck = [];
            $currentMember = $memberId;
            $maxLevels = 15; // Prevent infinite loops
            $level = 0;
            
            while ($currentMember && $level < $maxLevels) {
                $membersToCheck[] = $currentMember;
                
                // Find parent in achievement tree
                $achievementEntry = achievement_tree::where('memberid', $currentMember)->first();
                if ($achievementEntry && $achievementEntry->placement_id) {
                    $currentMember = $achievementEntry->placement_id;
                } else {
                    break; // Reached root or no parent
                }
                
                $level++;
            }
            
            Log::info("🔍 Found " . count($membersToCheck) . " members to check for achievement income eligibility: " . implode(', ', $membersToCheck));
            
            return $membersToCheck;
            
        } catch (\Exception $e) {
            Log::error("Error getting achievement tree upward hierarchy: " . $e->getMessage());
            return [$memberId]; // At least check the placed member
        }
    }
}
