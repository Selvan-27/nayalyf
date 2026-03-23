<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\team_performance_tree;
use App\Models\global_tree;
use App\Models\achievement_tree;
use App\Models\fast_track_tree;
use Illuminate\Support\Facades\Log;

class tree_traversal_controller extends Controller
{
    
       // breadth first search to find the placement id and position in binary tree / board 1 table use pos column to decide left side or right side

    /**
     * Perform breadth-first search to find the placement ID and position.
     * Updated to support tree_no parameter for multi-tree models
     */
    public function findPlacementAndPosition($startNodeId, $modelName, $treeNo = null)
    {
        // Resolve the dynamic model class
        $model = $this->getModelInstance($modelName);

        if (!$model) {
            return ['error' => 'Invalid model name.'];
        }

        // Handle case where start node is null (root placement)
        if ($startNodeId === null || $startNodeId === 'top') {
            return ['parentId' => null, 'nextPos' => 'root'];
        }

        $queue = [$startNodeId];

        while (!empty($queue)) {
            $currentNode = array_shift($queue);

            // Check if the current node has less than 3 children
            $childCount = $this->getChildCount($currentNode, $model, $treeNo);

            if ($childCount < 3) {
                $nextPos = $this->getPosition($childCount + 1);
                return ['parentId' => $currentNode, 'nextPos' => $nextPos];
            }

            // Get all children and add them to the queue
            $children = $this->getChildren($currentNode, $model, $treeNo);
            $queue = array_merge($queue, $children);
        }

        return ['error' => 'No suitable placement found.'];
    }

    /**
     * Get the count of children for a given parent node.
     */
    private function getChildCount($parentNodeId, $model, $treeNo = null)
    {
        $query = $model->where('placement_id', $parentNodeId);
        
        if ($treeNo !== null && $this->hasTreeNoColumn($model)) {
            $query->where('tree_no', $treeNo);
        }
        
        return $query->count();
    }

    /**
     * Get all children for a given parent node.
     */
    private function getChildren($parentNodeId, $model, $treeNo = null)
    {
        $query = $model->where('placement_id', $parentNodeId);
        
        if ($treeNo !== null && $this->hasTreeNoColumn($model)) {
            $query->where('tree_no', $treeNo);
        }
        
        return $query->pluck('memberid')->toArray();
    }

    /**
     * Check if model has tree_no column
     */
    private function hasTreeNoColumn($model)
    {
        $tableName = $model->getTable();
        return in_array($tableName, ['team_performance_tree', 'global_tree', 'achievement_tree', 'fast_track_tree']);
    }

    /**
     * Determine the next position based on the child index.
     */
    private function getPosition($childIndex)
    {
        switch ($childIndex) {

            case 1:
                return 'p1';
            case 2:
                return 'p2';
            case 3:
                return 'p3';
            default:
                return null; // or handle error as needed
        }
    }

    /**
     * Resolve the dynamic model instance based on the model name.
     */
    private function getModelInstance($modelName)
    {
        $modelClass = "App\\Models\\$modelName";

        if (class_exists($modelClass)) {
            return app($modelClass);
        }

        return null;
    }


public function countNodesBelow($id, $modelName)
{
    // Dynamically resolve the model
    $modelClass = "App\\Models\\$modelName";

    if (!class_exists($modelClass)) {
        return response()->json(['error' => 'Model not found'], 404);
    }

    // Initialize count and queue
    $count = 0;
    $queue = [$id]; // Start with the root node ID

    while (!empty($queue)) {
        // Get the next node ID to process
        $currentId = array_shift($queue);

        // Fetch immediate children
        $children = $modelClass::where('placement_id', $currentId)->pluck('memberid');

        // Add the count of children
        $count += $children->count();

        // Add the children to the queue for further processing
        $queue = array_merge($queue, $children->toArray());
    }

    return $count;
}



/**
 * Get six members below a given member ID for multiple boards.
 */
public function getSixMembersForAllBoards($memberId, $models)
{
    $result = [];

    foreach ($models as $modelName) {
        // Resolve the dynamic model class
        $model = $this->getModelInstance($modelName);

        if (!$model) {
            $result[$modelName] = ['error' => 'Invalid model name'];
            continue;
        }

        // Initialize queue and temp result array for the current board
        $queue = [$memberId];
        $boardResult = [];

        // Include the input memberId as the first node
        $boardResult[] = [
            'MemberID' => $memberId,
            'Name' => $model->where('memberid', $memberId)->value('FullName'), // Get name if needed
            'PlacementID' => null, // Root node has no placement
        ];

        // Perform BFS to collect remaining five members
        while (!empty($queue) && count($boardResult) < 6) {
            $currentNode = array_shift($queue);

            // Fetch children of the current node
            $children = $model->where('placement_id', $currentNode)->get();

            foreach ($children as $child) {
                if (count($boardResult) < 6) {
                    $boardResult[] = [
                        'MemberID' => $child->memberid,
                        'Name' => $child->name, // Adjust column name if different
                        'PlacementID' => $child->placement_id,
                    ];
                    $queue[] = $child->memberid; // Add child to queue for further exploration
                } else {
                    break; // Stop if we reach 6 members total
                }
            }
        }

        // Store the result for the current board
        $result[$modelName] = $boardResult;
    }

    // Return the result for all boards
    return ['boards' => $result];
}



// $models = ['board_1', 'board_2', 'board_3', 'board_4', 'board_5', 'board_6', 'board_7', 'board_8', 'board_9', 'board_10', 'board_11', 'board_12'];
// $response = $this->getSixMembersForAllBoards($memberId, $models);

// get 15 members including the input memberid for the given board 

public function getFifteenMembersForBoard($memberId, $modelName)
{
    // Resolve the dynamic model class
    $model = $this->getModelInstance($modelName);

    if (!$model) {
        return response()->json(['error' => 'Invalid model name.'], 400);
    }

    // Initialize queue and result array
    $queue = [$memberId];
    $result = [];

    // Fetch the root node (the input memberId)
    $rootMember = $model->where('memberid', $memberId)->first();
    if ($rootMember) {
        $result[] = [
            'MemberID' => $rootMember->memberid,
            'Name' => $rootMember->name,
            'PlacementID' => $rootMember->placement_id,
        ];
    }

    while (!empty($queue) && count($result) < 13) {
        $currentNode = array_shift($queue);

        // Fetch children of the current node
        $children = $model->where('placement_id', $currentNode)->get();

        foreach ($children as $child) {
            $result[] = [
                'MemberID' => $child->memberid,
                'Name' => $child->name, // Adjust column name if different
                'PlacementID' => $child->placement_id,
            ];

            $queue[] = $child->memberid; // Add child to the queue for further exploration

            if (count($result) >= 13) {
                break;
            }
        }
    }

    return ['members' => $result];
}



public function genealogy_list($modelName)
{
    $model = $this->getModelInstance($modelName);

    if (!$model) {
        return response()->json(['error' => 'Invalid model name.'], 400);
    }

    $members = $model::orderBy('id', 'asc')->get()->keyBy('memberid'); // fast access by ID

    $tree = [];
    $levelMap = [];
    $positionInLevel = [];
    $overallIndex = 0;

    // First, find the root node(s) - the ones with no placement_id
    foreach ($members as $member) {
        if (empty($model->where('memberid', $member->placement_id)->first())) {
            $tree[] = $member;
        }
    }

    $queue = [];

    foreach ($tree as $root) {
        $queue[] = [
            'member' => $root,
            'level' => 1,
        ];
    }

    $finalList = [];

    while (!empty($queue)) {
        $current = array_shift($queue);
        $member = $current['member'];
        $level = $current['level'];

        $overallIndex++;

        // Track position in level
        if (!isset($positionInLevel[$level])) {
            $positionInLevel[$level] = 1;
        } else {
            $positionInLevel[$level]++;
        }

        // Attach info
        $member->member_level = $level;
        $member->over_all_index = $overallIndex;
        $member->position_in_level = $positionInLevel[$level];

        $finalList[] = $member;

        // Find children (3 max in ternary)
        foreach ($members as $child) {
            if ($child->placement_id === $member->memberid) {
                $queue[] = [
                    'member' => $child,
                    'level' => $level + 1,
                ];
            }
        }
    }

    return $finalList;

    // return view('admin.genealogy_list', ['data' => $finalList]);
}

    /**
     * Find placement using team filling method
     * Starts from sponsor and searches downward through sponsor's lineage
     */
    public function findTeamPlacement($sponsorId, $modelName, $treeNo = null)
    {
        $model = $this->getModelInstance($modelName);
        
        if (!$model) {
            return ['error' => 'Invalid model name.'];
        }

        // Check if sponsor exists in this tree
        $query = $model->where('memberid', $sponsorId);
        if ($treeNo !== null && $this->hasTreeNoColumn($model)) {
            $query->where('tree_no', $treeNo);
        }
        
        $sponsorInTree = $query->first();
        
        if (!$sponsorInTree) {
            // Sponsor not in tree, use global filling from manually added root
            $rootQuery = $model;
            if ($treeNo !== null && $this->hasTreeNoColumn($model)) {
                $rootQuery = $rootQuery->where('tree_no', $treeNo);
            }
            
            // Look for manually added root node (placement_id is null)
            $rootMember = $rootQuery->whereNull('placement_id')->first();
            
            if (!$rootMember) {
                Log::warning("No root node found in $modelName tree $treeNo for team placement - this may indicate missing manual root setup");
                return ['parentId' => null, 'nextPos' => 'root'];
            }
            
            return $this->findPlacementAndPosition($rootMember->memberid, $modelName, $treeNo);
        }

        // Use team filling starting from sponsor
        return $this->findPlacementAndPosition($sponsorId, $modelName, $treeNo);
    }

    /**
     * Find placement using global filling method  
     * Starts from the root of the tree and uses breadth-first search
     */
    public function findGlobalPlacement($modelName, $treeNo = null)
    {
        $model = $this->getModelInstance($modelName);
        
        if (!$model) {
            return ['error' => 'Invalid model name.'];
        }

        // Find the root member in this tree (manually added root node)
        $query = $model;
        if ($treeNo !== null && $this->hasTreeNoColumn($model)) {
            $query = $query->where('tree_no', $treeNo);
        }
        
        // Look specifically for root nodes (placement_id is null)
        $rootMember = $query->whereNull('placement_id')->first();
        
        if (!$rootMember) {
            // No root node found, this tree doesn't have a manually added root yet
            // This should not happen as per the requirement that root nodes are manually added
            Log::warning("No root node found in $modelName tree $treeNo - this may indicate missing manual root setup");
            return ['parentId' => null, 'nextPos' => 'root'];
        }

        // Use breadth-first search starting from the root node
        return $this->findPlacementAndPosition($rootMember->memberid, $modelName, $treeNo);
    }

    /**
     * Count direct children in specific tree
     */
    public function countDirectChildren($memberId, $modelName, $treeNo = null)
    {
        $model = $this->getModelInstance($modelName);
        
        if (!$model) {
            return 0;
        }

        $query = $model->where('placement_id', $memberId);
        if ($treeNo !== null && $this->hasTreeNoColumn($model)) {
            $query->where('tree_no', $treeNo);
        }
        
        return $query->count();
    }

    /**
     * Find the root Fast Track patriarch by traversing up the all_father_id chain
     * This handles cases where fast track rebirths create more fast track rebirths
     */
    public function findFastTrackRootPatriarch($memberId)
    {
        try {
            Log::info("🔍 Finding Fast Track root patriarch for member: $memberId");
            
            $currentMemberId = $memberId;
            $visitedMembers = []; // Prevent infinite loops
            $maxLevels = 10; // Safety limit
            $level = 0;
            
            while ($currentMemberId && $level < $maxLevels) {
                // Prevent infinite loops
                if (in_array($currentMemberId, $visitedMembers)) {
                    Log::warning("Circular reference detected in Fast Track patriarch chain for member: $memberId");
                    break;
                }
                
                $visitedMembers[] = $currentMemberId;
                
                // Get current member's plan
                $memberPlan = \App\Models\mlm_plan::where('memberid', $currentMemberId)->first();
                
                if (!$memberPlan) {
                    Log::warning("Member plan not found for: $currentMemberId");
                    break;
                }
                
                // If this member has no all_father_id, they are the root patriarch
                if (!$memberPlan->all_father_id) {
                    Log::info("✅ Found Fast Track root patriarch: $currentMemberId (no all_father_id)");
                    return $currentMemberId;
                }
                
                // If all_father_id is the same as memberid, they are the root
                if ($memberPlan->all_father_id === $currentMemberId) {
                    Log::info("✅ Found Fast Track root patriarch: $currentMemberId (self-referencing all_father_id)");
                    return $currentMemberId;
                }
                
                Log::info("📈 Level $level: $currentMemberId → all_father_id: {$memberPlan->all_father_id}");
                
                // Move up the chain
                $currentMemberId = $memberPlan->all_father_id;
                $level++;
            }
            
            // If we reach here, return the last valid member in the chain
            $rootPatriarch = $visitedMembers[0] ?? $memberId;
            Log::info("✅ Fast Track root patriarch (fallback): $rootPatriarch");
            
            return $rootPatriarch;
            
        } catch (\Exception $e) {
            Log::error("Error finding Fast Track root patriarch for member $memberId: " . $e->getMessage());
            return $memberId; // Fallback to the original member
        }
    }

}
