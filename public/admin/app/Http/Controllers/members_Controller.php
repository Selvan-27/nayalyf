<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\coin;
use App\Models\UserOtp;
use App\Models\admin;
use App\Models\mlm_plan;
use App\Models\plan_activation_queue;
use App\Models\board_1;
use App\Models\board_2;
use App\Models\board_3;
use App\Models\board_4;
use App\Models\board_user_income;
use App\Models\BoardUserIncome2;
use App\Models\detailsofuser;
use App\Models\legcount;
use App\Models\levelincome;
use App\Models\plan_wallet;
use App\Models\withdraw_history;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Http;

use App\Services\WalletService;


class members_Controller extends Controller
{
   
        

public function members(Request $request){
  

     $members = mlm_plan::join('users', 'users.memberid', '=', 'mlm_plan.memberid')
    ->leftJoin(DB::raw('(SELECT memberid, SUM(amount) as total_package FROM plan_wallet GROUP BY memberid) as pw'), 'pw.memberid', '=', 'mlm_plan.memberid')
    //->leftJoin('board_1', 'board_1.memberid', '=', 'mlm_plan.memberid')
       ->leftJoin('users as sponsor_users', 'sponsor_users.memberid', '=', 'mlm_plan.sponsor_id')
    ->select(
        'users.*',
        'mlm_plan.*',
        // 'board_1.created_at as active_date',
         'sponsor_users.name as sponsor_name',
        DB::raw('COALESCE(pw.total_package, 0) as package_amount')
    )
    ->get();

// Add activation status
foreach ($members as $member) {
    //$member->refer_count = mlm_plan::where('sponsor_id', $member->memberid)->count('memberid');

    $member->activation_status = $member->board_memberid ? 'Active' : 'Inactive';
    
    // total referral count of regular members

    $member->refer_count_total = mlm_plan::where('mlm_plan.sponsor_id', $member->memberid)->where('mlm_plan.memberid_type', 'regular')->count();

     $member->refer_count = mlm_plan::where('mlm_plan.sponsor_id', $member->memberid)->where('mlm_plan.memberid_type', 'regular')->join('plan_activation_queue', 'plan_activation_queue.activation_id', '=', 'mlm_plan.memberid')->where('plan_activation_queue.activation_status', 'success')->count();
    $member->activation_date = plan_activation_queue::where('activation_id', $member->memberid)->value('activation_date');
    $member->activation_by = plan_activation_queue::where('activation_id', $member->memberid)->value('login_id');
    
}

    $active = $members->where('activation_status', 'Active')->count();

    $inactive = $members->where('activation_status', 'Inactive')->count();
 
       $UG = mlm_plan::where('memberid', 'like', 'UG%')->count();
      
       $RI = mlm_plan::where('memberid', 'like', 'RI%')
                ->count();
   
    
  $data= $members; 
  

                
    return view('members', compact('data', 'active', 'inactive'));
}

        
        
         public function search(Request $request){
    
             $id=$request->q;
             
              $data = [];
              $users=[];
            return $users = User::where('memberid','=',$id)->first();

                return view('admin.search', compact('data','users'))->with('error', 'User not found!');
                
            // return view('admin.search', compact('data','users'));
         
         }

         
          public function edit(Request $request){
    
            $id=$request->q;
             
            $data = [];
            $users=[];
            
                        
        //      return $users = DB::table('mlm_plan')
        // ->join('users as from_user', 'from_user.memberid', '=', 'mlm_plan.sponsor_id')
        // ->join('users as to_user', 'to_user.memberid', '=', 'mlm_plan.memberid')
        // ->where('to_user.memberid','=',$id)
        // ->select(
        //     'from_user.name as fname',   // Referrer name
        //     'from_user.profile_photo as fphoto',   // Referrer name
            
        //     'to_user.name as tname',     // Receiver name
        //     'to_user.profile_photo as tphoto'
        // )
        // ->get();
        
        //         return  $users = mlm_plan::join('users as to_user', 'to_user.memberid', '=', 'mlm_plan.memberid')->where('to_user.memberid','=',$id) ->select(
        //     'mlm_plan.FullName as fname',   // Referrer name
            
        //     'to_user.name as tname',     // Receiver name
        //     'to_user.profile_photo as tphoto'
        // )
        // ->get();
            $users = User::where('memberid','=',$id)->first();
           
            return view('memedit', compact('data','users'))->with('error', 'User not found!');
                
            // return view('admin.search', compact('data','users'));
         
         }
         
         
          public function profile_update(Request $request){
             
           $mid=$request->memberid;
            $username=$request->name;
            $mobile=$request->mobile;
            $Password=$request->Password;
            
            $new_pwd=$request->new_pwd;
            
            if($new_pwd){
                $pwd=$new_pwd;
            }else{
                $pwd=$Password;
            }
            
            $real_email=$request->real_email;
       
            //$users = User::where('memberid','=',$mid)->first();
     $user = User::where('memberid', '=', $mid)->first();
    if ($user) {
    
    $user->name = $username;
    $user->mobile = $mobile;
    $user->password = bcrypt($pwd);
    $user->pwd = $pwd; // assuming you want to hash the password
    $user->real_email = $real_email;
    $user->save();
    
    
     $user1 = mlm_plan::where('memberid', '=', $mid)->first();

     
        if ($user1) {
           // dd($user1);
            $user1->FullName = $username;
            $user1->save();
        }
            // You can return a success response
            return back()->with('success','User updated successfully');
        } else {
            // Handle the case where the user is not found
            return back()->with('error', 'User not found!');
        }
                      
          }    
          
    public function crypto_wallet_update(Request $request){
             
           $mid=$request->memberid;
           
     $user = User::where('memberid', '=', $mid)->first();
     
        if ($user) {
        $user->wallet = $request->crypto_wallet;
        $user->save();

    return back()->with('csuccess','Crypto Wallet updated successfully');
} else {
    // Handle the case where the user is not found
    return back()->with('cerror', 'User not found!');
}
              
          }
          
          
              public function getModelInstance($modelName)
    {
        $modelClass = "App\\Models\\$modelName";

        if (class_exists($modelClass)) {
            return app($modelClass);
        }

        return null;
    }
          
          
public function view_binary_tree_admin($modelName,$memberId=null) {

    $tree_traversal_controller = new tree_traversal_controller();

    $top_id = mlm_plan::orderBy('id', 'asc')->first()->memberid;


    if(empty($memberId)){
        $memberId = $top_id;
    }
    
       $model = $this->getModelInstance($modelName);

    if (!$model) {
        return response()->json(['error' => 'Invalid model name.'], 400);
    }
    
     $rootMember = $model->where('memberid', $memberId)->first();
     
        $empty=0;
if (empty($rootMember)) {
    
     // return back()->with('cerror', 'board is empty!');
     //return response()->json(['error' => 'board is empty']);
     
     $empty=1;
     
       return view('admin.binary_tree', compact('empty'));
}


    

    // Call the getFifteenMembersForBoard function
    $result = $tree_traversal_controller->getFifteenMembersForBoard($memberId, $modelName);

  //  dd($result);
    $index_in_board = $tree_traversal_controller->getMemberIndexInBoard($memberId, $modelName);

    $index_in_board = $index_in_board + 1;


    $level_and_position = $tree_traversal_controller->getMemberLevelAndPosition($memberId, $modelName);


    // find plcement id of the memberid from given model

    $model = $tree_traversal_controller->getModelInstance($modelName);
    
    if (!$model) {
        return response()->json(['error' => 'Invalid model name.'], 400);
    }

    
    $placement_id = $model->where('memberid', $memberId)->first();

  
    // Check if the model exists
    // Check for errors or invalid results
    if (isset($result['error'])) {
        return response()->json(['error' => $result['error']], 400);
    }

    $members = $result['members'];

   

    // Preprocess the data for frontend (if necessary)
    $treeData = $this->formatTreeData($members);

    // Pass the tree data to the view
    return view('admin.binary_tree', compact('treeData', 'index_in_board', 'level_and_position','memberId', 'placement_id','empty'));


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

    return view('admin.genealogy_list', ['data' => $finalList]);
}



private function formatTreeData($members)
{
    // Create an associative array to map member IDs to their nodes
    $map = [];
    foreach ($members as $member) {
        $map[$member['MemberID']] = $member + ['children' => []];
    }

    // Build the tree structure
    $tree = [];
    foreach ($map as $id => &$node) {
        if (isset($map[$node['PlacementID']])) {
            $map[$node['PlacementID']]['children'][] = &$node;
        } else {
            $tree[] = &$node; // Root node(s)
        }
    }

    return $tree;
}


public function get_member_details(Request $request){
    $id=$request->memberid;
    $user = User::where('memberid', $id)->first();
    if (!$user) {
        return response()->json(['error' => 'User not found!']);
    }

    $user->refer_count = mlm_plan::where('sponsor_id', $user->memberid)->count('memberid');
    
    $st = plan_activation_queue::where('activation_id', $user->memberid)->value('activation_status');
    
    $user->activation_status = ($st == "success") ? 'Active' : 'Inactive';
    
    return response()->json($user);
}


public function members_withdraw_list(){ $data = []; return view('memwithlist', compact('data')); }



}
