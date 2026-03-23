<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\booster_income;
use App\Models\team_performance_tree;
use App\Models\fast_track_tree;
use App\Models\fast_track_income;
use App\Models\mlm_plan;
use App\Models\achievement_level_income;
use App\Models\referral_income;
use App\Models\re_ignite_income;
use App\Models\awarded_members;

use App\Models\plan_wallet;
use App\Models\User;
use App\Models\leaders_level_income;
use App\Models\leaders_matrix_income;
use App\Models\repurchase_level_income;
use App\Models\repurchase_cutoff_slots;


use App\Models\plan_activation_queue;
use App\Models\withdraw_history;
use App\Models\Orders;
use App\Models\awards_and_rewards_cutoff_slots;
use App\Models\unique_incentive_income;

use App\Services\WalletService;


class user_controller extends Controller
{

public function login(){$data = []; return view('login', compact('data'));}
public function inactive(){$data = []; return view('inactive', compact('data'));}


public function register(){$data = []; return view('regist', compact('data'));}
public function forgetpassword(){$data = []; return view('forgot-password', compact('data'));}
public function welcome(){
    
    $data=[];
//          $data = referral_income::join('users', 'referral_income.fromId', '=', 'users.memberid') ->join('plan_activation_queue', 'referral_income.fromId', '=', 'plan_activation_queue.activation_id')
// ->where('referral_income.memberid', Auth::user()->memberid)
// ->select('referral_income.*', 'users.name','users.profile_photo', 'users.real_email as email','users.mobile', 'plan_activation_queue.activation_status','plan_activation_queue.activation_date as date') // select needed columns 
// ->get();

return view('welcome', compact('data'));}

public function affiliate(){ 
    
    $data = []; 
     $unique_incentive_income = DB::table('unique_incentive_income')
            ->where('memberid', Auth::user()->memberid)
            ->sum('netpay');
            
    return view('affiliate', compact('data','unique_incentive_income'));}
public function affiliateterms(){$data = []; return view('affiliateterms', compact('data'));}
public function userterms(){$data = []; return view('userterms', compact('data'));}

public function notification(){$data = []; return view('notification', compact('data'));}

public function payment(){$data = []; return view('payment', compact('data'));}
public function ordertrack(){$data = []; return view('ordertrack', compact('data'));}
public function order(){$data = []; return view('order', compact('data'));}
public function productdetails(){$data = []; return view('productdetails', compact('data'));}

public function dashboard(){$data = []; return view('dash', compact('data'));}
public function wallet(){ 
 $login_id = Auth::user()->memberid;
 $withdraw_pending = withdraw_history::where('status','pending')->where('memberid', $login_id)->get();
 $withdraw_success = withdraw_history::where('status','success')->where('memberid', $login_id)->get();
 
  $withdraw_cancel = withdraw_history::where('status','cancel')->where('memberid', $login_id)->get();
     
     $activation = plan_activation_queue::where('login_id', $login_id)->where('activation_id', 'like', 'UC%')->where('activation_status', 'success')->count();
     $activation_amt=$activation*1600;
     $orders = orders::where('user_id', $login_id)->where('from_income_wallet','!=', 0)->sum('from_income_wallet');    

return view('wallet', compact('withdraw_pending','withdraw_cancel','withdraw_success','orders','activation_amt'));}

//return view('wallet', compact('data'));}
public function transaction(){

    
      $login_id = Auth::user()->memberid;
    $activation = plan_activation_queue::where('login_id', $login_id)->where('activation_id', 'like', 'UC%')->get();
    $withdraw = withdraw_history::where('memberid', $login_id)->get();
    $orders = orders::where('user_id', $login_id)->where('from_income_wallet','!=', 0)->get();
    
return view('alltrans', compact('activation','withdraw','orders'));}
public function account(){$data = []; return view('account', compact('data'));}
public function accountinactive(){$data = []; return view('accountinactive', compact('data'));}
public function addres(){$data = []; return view('addres', compact('data'));}

public function invite(){ 
    
      $login_id = Auth::user()->memberid;

     $data = referral_income::join('users', 'referral_income.fromId', '=', 'users.memberid') ->join('plan_activation_queue', 'referral_income.fromId', '=', 'plan_activation_queue.activation_id')
->where('referral_income.memberid', Auth::user()->memberid)
->select('referral_income.*', 'users.name','users.profile_photo', 'users.real_email as email','users.mobile', 'plan_activation_queue.activation_status','plan_activation_queue.activation_date as date')
->get();

    $inactive = mlm_plan::join('users', 'mlm_plan.memberid', '=', 'users.memberid')
    ->where('mlm_plan.sponsor_id', Auth::user()->memberid)
    ->where('mlm_plan.status', 0)
    ->select('users.name','users.memberid','users.profile_photo', 'users.real_email as email','users.mobile', 'mlm_plan.jdate as date') // select needed columns 
    ->get();


 $unique_incentive_income = DB::table('unique_incentive_income')
            ->where('memberid', Auth::user()->memberid)
            ->sum('netpay');
            
      $total = referral_income::where('memberid', $login_id)->sum('payout');

    return view('invite', compact('data','total','inactive','unique_incentive_income')); 
    
    
}

public function incentive(){
    $login_id = Auth::user()->memberid;
    
    // Get unique incentive income data with user details
    $data = unique_incentive_income::join('users', 'unique_incentive_income.fromId', '=', 'users.memberid')
        ->where('unique_incentive_income.memberid', $login_id)
        ->select(
            'unique_incentive_income.*', 
            'users.name',
            'users.real_email as email',
            'users.mobile'
        )
        ->orderBy('unique_incentive_income.created_at', 'desc')
        ->get();
    
    // Calculate total payout
    $unique_incentive_payout = unique_incentive_income::where('memberid', $login_id)->sum('payout');
    
    return view('incentive', compact('data', 'unique_incentive_payout'));
}

public function todo(){$data = []; return view('todo', compact('data'));}
public function todocontact(){$data = []; return view('todocontact', compact('data'));}
public function todoform(){$data = []; return view('todoform', compact('data'));}
public function todotask(){$data = []; return view('todotask', compact('data'));}
public function todoteam(){$data = []; return view('todoteam', compact('data'));}
public function todotool(){$data = []; return view('todotool', compact('data'));}
public function material(){
    $data = []; 
     $path = public_path('materials');

    $files = File::files($path);
    
    return view('material', compact('files'));}
public function todotraining(){$data = []; return view('todotraining', compact('data'));}
public function todovideolist(){$data = []; return view('todovideolist', compact('data'));}

public function profileedit(){$data = []; return view('editprofile', compact('data'));}
public function profileentry(){$data = []; return view('profilefirst', compact('data'));}
public function bankedit(){$data = []; return view('editbank', compact('data'));}
public function idapply(){$data = []; return view('idcform', compact('data'));}
public function changepassword(){$data = []; return view('passwordmanager', compact('data'));}
public function successpassword(){$data = []; return view('passwordsuccessfully', compact('data'));}
public function help(){$data = []; return view('help', compact('data'));}
public function contact(){$data = []; return view('contact', compact('data'));}

public function get(){$data = []; return view('get', compact('data'));}


public function award(Request $request){
    $login_id = Auth::user()->memberid;
    
    // Get filter parameter from request
    $filter_award = $request->get('filter_award', 0);
    
    // Base query with joins
    $query = awarded_members::join('awards_and_rewards_cutoff_slots', 'awarded_members.cutoff_slot_id', '=', 'awards_and_rewards_cutoff_slots.id')
        ->where('awarded_members.memberid', $login_id)
        ->select(
            'awarded_members.*',
            'awards_and_rewards_cutoff_slots.name as cutoff_name'
        );
    
    // Apply filter if provided and not "All Awards"
    if ($filter_award && $filter_award > 0) {
        // Map filter values to award names
        $award_mapping = [
            1 => 'BWD-Bronze Wellness Distributor',
            2 => 'SSD-Silver Star Distributor', 
            3 => 'GED-Golden Elite Distributor',
            4 => 'PD-Platinum Distributor',
            5 => 'DD-Dynamic Distributor',
            6 => 'RD-Rhodium Distributor',
            7 => 'UCA-UC Ambassador',
            8 => 'DA-Diamond Ambassador',
            9 => 'EA-Elite Ambassador',
            10 => 'TA-Titan Ambassador',
            11 => 'DDD-Double Diamond Director',
            12 => 'DED-Double Elite Director',
            13 => 'DTD-Double Titan Director',
            14 => 'CD-Crown Director'
        ];
        
        if (isset($award_mapping[$filter_award])) {
            $query->where('awarded_members.award', $award_mapping[$filter_award]);
        }
    }
    
    $data = $query->orderBy('awarded_members.created_at', 'desc')->get();
    
    // Get all available cutoff slots for potential future use
    $cutoff_slots = awards_and_rewards_cutoff_slots::orderBy('name')->get();
    
    // Get member rank for display
    $user = Auth::user();
    $member_rank = $user->rank ?? $user->member_rank ?? 'Member'; // Try different field names
    
    return view('award', compact('data', 'cutoff_slots', 'member_rank'));
}public function ignite(){
    
      $login_id = Auth::user()->memberid;

     $data = referral_income::join('users', 'referral_income.fromId', '=', 'users.memberid') ->join('plan_activation_queue', 'referral_income.fromId', '=', 'plan_activation_queue.activation_id')
->where('referral_income.memberid', Auth::user()->memberid)
->select('referral_income.*', 'users.name','users.profile_photo', 'users.real_email as email','users.mobile', 'plan_activation_queue.activation_status','plan_activation_queue.activation_date as date')
->get();

    $inactive = mlm_plan::join('users', 'mlm_plan.memberid', '=', 'users.memberid')
    ->where('mlm_plan.sponsor_id', Auth::user()->memberid)
    ->where('mlm_plan.status', 0)
    ->select('users.name','users.memberid','users.profile_photo', 'users.real_email as email','users.mobile', 'mlm_plan.jdate as date') // select needed columns 
    ->get();

//       $inactive = referral_income::join('users', 'referral_income.fromId', '=', 'users.memberid') ->join('plan_activation_queue', 'referral_income.fromId', '=', 'plan_activation_queue.activation_id')
// ->where('referral_income.memberid', Auth::user()->memberid)
// ->select('referral_income.*', 'users.name','users.profile_photo', 'users.real_email as email','users.mobile', 'plan_activation_queue.activation_status','plan_activation_queue.activation_date as date') // select needed columns 
// ->get();

      $total = referral_income::where('memberid', $login_id)->sum('payout');

    return view('incomerefer', compact('data','total','inactive'));
}
public function reignite(){
    // rebirth_count and rebirth_ids are now available globally via WalletComposer
    // reignite_payout and reignite_netpay are also available globally via WalletComposer
    
    //  return $data = re_ignite_income::join('users', 're_ignite_income.fromId', '=', 'users.memberid')
    //     ->join('plan_activation_queue', 're_ignite_income.fromId', '=', 'plan_activation_queue.activation_id')
    // ->where('re_ignite_income.memberid', Auth::user()->memberid)
    // ->select('re_ignite_income.*', 'users.name', 'users.real_email as email','users.mobile', 'plan_activation_queue.activation_status','plan_activation_queue.date') // select needed columns
    // ->get();
    
    return view('incomerebirth');
}

public function incomeboost(){

    $login_id = Auth::user()->memberid;

     $data = booster_income::join('users', 'booster_income.fromId', '=', 'users.memberid') ->join('plan_activation_queue', 'booster_income.fromId', '=', 'plan_activation_queue.activation_id')
->where('booster_income.memberid', Auth::user()->memberid)
->select('booster_income.*', 'users.name','users.profile_photo', 'users.real_email as email','users.mobile')
->where('booster_income.spl_count','!=','0')
->get();

  $total = booster_income::where('booster_income.memberid', Auth::user()->memberid)->where('status',1)
->sum('payout');

$spl_count = booster_income::where('booster_income.memberid', Auth::user()->memberid)->where('spl_count','!=','0')
->sum('spl_count');

return view('incomeboost', compact('data','total','spl_count'));}



public function teamper(Request $request){
    $login_id = Auth::user()->memberid;
    
    // Get selected member ID (can be login ID, rebirth ID, or repurchase ID)
    $selected_member_id = $request->input('selected_id', $login_id);
    
    // Get current tree number (default to 1)
    $current_tree_no = $request->input('tree_no', 1);
    
    // Get root member for current tree (default to selected member)
    $root_member_id = $request->input('root', $selected_member_id);
    
    // Get all related IDs for dropdown
    $related_ids = $this->getAllRelatedIds($login_id);
    
    // Validate that the selected member ID belongs to the login user
    $valid_ids = array_column($related_ids, 'memberid');
    if (!in_array($selected_member_id, $valid_ids)) {
        $selected_member_id = $login_id; // Reset to login user if invalid
        $root_member_id = $login_id;
    }
    
    // Validate that the requested root is a descendant of selected member (security check)
    if ($root_member_id !== $selected_member_id) {
        $is_descendant = $this->isDescendantInTeamTree($selected_member_id, $root_member_id, $current_tree_no);
        if (!$is_descendant) {
            $root_member_id = $selected_member_id; // Reset to selected member if not a descendant
        }
    }
    
    // Get all 15 trees status for the selected member
    $all_trees_status = [];
    for ($i = 1; $i <= 15; $i++) {
        $user_in_tree = DB::table('team_performance_tree')
            ->where('memberid', $selected_member_id)
            ->where('tree_no', $i)
            ->first();
        $all_trees_status[$i] = $user_in_tree ? 'active' : 'inactive';
    }
    
    // Get current tree data
    $tree_data = null;
    if ($all_trees_status[$current_tree_no] === 'active') {
        $root_node = DB::table('team_performance_tree')
            ->leftJoin('mlm_plan', 'team_performance_tree.memberid', '=', 'mlm_plan.memberid')
            ->where('team_performance_tree.memberid', $root_member_id)
            ->where('team_performance_tree.tree_no', $current_tree_no)
            ->select('team_performance_tree.*', 'mlm_plan.FullName')
            ->first();
            
        if ($root_node) {
            $tree_data = $this->getTeamPerformanceTernaryTree($root_node, $current_tree_no, 2);
        }
    }
    
     $tbl_list = DB::table('team_performance_income')
            ->where('team_performance_income.memberid', $root_member_id)
            ->where('team_performance_income.tree_number', $current_tree_no)
            ->where('team_performance_income.ignored', 0)
            ->get();
    
    // Get user info
    $user_info = DB::table('mlm_plan')->where('memberid', $login_id)->first();
    
    $data = [
        'tree_data' => $tree_data,
        'current_tree_no' => $current_tree_no,
        'root_member_id' => $root_member_id,
        'selected_member_id' => $selected_member_id,
        'login_id' => $login_id,
        'all_trees_status' => $all_trees_status,
        'user_info' => $user_info,
        'tbl_list' => $tbl_list,
        'related_ids' => $related_ids
    ];
    
    return view('incomeperformance', compact('data'));
}

/**
 * Get all related IDs (login ID, rebirth IDs, repurchase IDs) for dropdown
 */
private function getAllRelatedIds($login_id) {
    $related_ids = [];
    
    // 1. Add login ID first
    $login_member = DB::table('mlm_plan')->where('memberid', $login_id)->first();
    if ($login_member) {
        $related_ids[] = [
            'memberid' => $login_member->memberid,
            'FullName' => $login_member->FullName ?? 'N/A',
            'type' => 'Login ID',
            'memberid_type' => $login_member->memberid_type ?? 'regular'
        ];
    }
    
    // 2. Get all rebirth IDs where original_id = login_id
    $rebirth_ids = DB::table('mlm_plan')
        ->where('original_id', $login_id)
        ->where('memberid_type', 'rebirth')
        ->orderBy('created_at')
        ->get();
        
    foreach ($rebirth_ids as $rebirth) {
        $related_ids[] = [
            'memberid' => $rebirth->memberid,
            'FullName' => $rebirth->FullName ?? 'N/A',
            'type' => 'Rebirth ID',
            'memberid_type' => $rebirth->memberid_type
        ];
    }
    
    // 3. Get all repurchase IDs where all_father_id = login_id
    $repurchase_ids = DB::table('mlm_plan')
        ->where('all_father_id', $login_id)
        ->where('memberid_type', 'repurchase')
        ->orderBy('created_at')
        ->get();
        
    foreach ($repurchase_ids as $repurchase) {
        $related_ids[] = [
            'memberid' => $repurchase->memberid,
            'FullName' => $repurchase->FullName ?? 'N/A',
            'type' => 'Repurchase ID',
            'memberid_type' => $repurchase->memberid_type
        ];
    }
    
    return $related_ids;
}


/**
 * Get all related IDs including fast_track_rebirth (for Fast Track page only)
 */
private function getAllRelatedIdsForglobal_tree_rebirth($login_id) {
    $related_ids = [];
    
    // 1. Add login ID first
    $login_member = DB::table('mlm_plan')->where('memberid', $login_id)->first();
    if ($login_member) {
        $related_ids[] = [
            'memberid' => $login_member->memberid,
            'FullName' => $login_member->FullName ?? 'N/A',
            'type' => 'Login ID',
            'memberid_type' => $login_member->memberid_type ?? 'regular'
        ];
    }
    
    // 2. Get all rebirth IDs where original_id = login_id
  
      $rebirth_ids  = DB::table('mlm_plan')
        ->where('all_father_id', $login_id)
        ->where('memberid_type', 'global_tree_rebirth')
        ->orderBy('created_at')
        ->get();
        
    foreach ($rebirth_ids as $rebirth) {
        $related_ids[] = [
            'memberid' => $rebirth->memberid,
            'FullName' => $rebirth->FullName ?? 'N/A',
            'type' => 'Rebirth ID',
            'memberid_type' => $rebirth->memberid_type
        ];
    }
    
    // 3. Get all repurchase IDs where all_father_id = login_id
    $repurchase_ids = DB::table('mlm_plan')
        ->where('all_father_id', $login_id)
        ->where('memberid_type', 'repurchase')
        ->orderBy('created_at')
        ->get();
        
    foreach ($repurchase_ids as $repurchase) {
        $related_ids[] = [
            'memberid' => $repurchase->memberid,
            'FullName' => $repurchase->FullName ?? 'N/A',
            'type' => 'Repurchase ID',
            'memberid_type' => $repurchase->memberid_type
        ];
    }
    
    // 4. Get all fast_track_rebirth IDs where original_id = login_id (Fast Track specific)
    $fast_track_rebirth_ids = DB::table('mlm_plan')
        ->where('original_id', $login_id)
        ->where('memberid_type', 'fast_track_rebirth')
        ->orderBy('created_at')
        ->get();
        
    foreach ($fast_track_rebirth_ids as $ft_rebirth) {
        $related_ids[] = [
            'memberid' => $ft_rebirth->memberid,
            'FullName' => $ft_rebirth->FullName ?? 'N/A',
            'type' => 'Fast Track Rebirth ID',
            'memberid_type' => $ft_rebirth->memberid_type
        ];
    }
    
    return $related_ids;
}

private function getAllRelatedIdsForFastTrack($login_id) {
    $related_ids = [];
    
    // 1. Add login ID first
    $login_member = DB::table('mlm_plan')->where('memberid', $login_id)->first();
    if ($login_member) {
        $related_ids[] = [
            'memberid' => $login_member->memberid,
            'FullName' => $login_member->FullName ?? 'N/A',
            'type' => 'Login ID',
            'memberid_type' => $login_member->memberid_type ?? 'regular'
        ];
    }
    
    // 2. Get all rebirth IDs where original_id = login_id
    $rebirth_ids = DB::table('mlm_plan')
        ->where('original_id', $login_id)
        ->where('memberid_type', 'rebirth')
        ->orderBy('created_at')
        ->get();
        
    foreach ($rebirth_ids as $rebirth) {
        $related_ids[] = [
            'memberid' => $rebirth->memberid,
            'FullName' => $rebirth->FullName ?? 'N/A',
            'type' => 'Rebirth ID',
            'memberid_type' => $rebirth->memberid_type
        ];
    }
    
    // 3. Get all repurchase IDs where all_father_id = login_id
    $repurchase_ids = DB::table('mlm_plan')
        ->where('all_father_id', $login_id)
        ->where('memberid_type', 'repurchase')
        ->orderBy('created_at')
        ->get();
        
    foreach ($repurchase_ids as $repurchase) {
        $related_ids[] = [
            'memberid' => $repurchase->memberid,
            'FullName' => $repurchase->FullName ?? 'N/A',
            'type' => 'Repurchase ID',
            'memberid_type' => $repurchase->memberid_type
        ];
    }
    
    // 4. Get all fast_track_rebirth IDs where original_id = login_id (Fast Track specific)
    $fast_track_rebirth_ids = DB::table('mlm_plan')
        ->where('original_id', $login_id)
        ->where('memberid_type', 'fast_track_rebirth')
        ->orderBy('created_at')
        ->get();
        
    foreach ($fast_track_rebirth_ids as $ft_rebirth) {
        $related_ids[] = [
            'memberid' => $ft_rebirth->memberid,
            'FullName' => $ft_rebirth->FullName ?? 'N/A',
            'type' => 'Fast Track Rebirth ID',
            'memberid_type' => $ft_rebirth->memberid_type
        ];
    }
    
    return $related_ids;
}

/**
 * Check if a member is descendant of selected member in team performance tree
 */
private function isDescendantInTeamTree($ancestor_id, $descendant_id, $tree_no) {
    // Get descendant node
    $descendant_node = DB::table('team_performance_tree')
        ->where('memberid', $descendant_id)
        ->where('tree_no', $tree_no)
        ->first();
        
    if (!$descendant_node) return false;
    
    // Traverse up the tree to check if we reach the ancestor
    $current_id = $descendant_node->placement_id;
    $max_levels = 20; // Prevent infinite loops
    $levels_checked = 0;
    
    while ($current_id && $levels_checked < $max_levels) {
        if ($current_id === $ancestor_id) {
            return true;
        }
        
        $parent_node = DB::table('team_performance_tree')
            ->where('memberid', $current_id)
            ->where('tree_no', $tree_no)
            ->first();
            
        $current_id = $parent_node ? $parent_node->placement_id : null;
        $levels_checked++;
    }
    
    return false;
}

/**
 * Build ternary tree structure recursively
 */
private function getTeamPerformanceTernaryTree($node, $tree_no, $levels) {
    if ($levels < 0 || !$node) return null;
    
    $children = [];
    foreach (["p1", "p2", "p3"] as $pos) {
        $child = DB::table('team_performance_tree')
            ->leftJoin('mlm_plan', 'team_performance_tree.memberid', '=', 'mlm_plan.memberid')
            ->where('team_performance_tree.placement_id', $node->memberid)
            ->where('team_performance_tree.pos', $pos)
            ->where('team_performance_tree.tree_no', $tree_no)
            ->select('team_performance_tree.*', 'mlm_plan.FullName')
            ->first();
        $children[$pos] = $child ? $this->getTeamPerformanceTernaryTree($child, $tree_no, $levels - 1) : null;
    }
    
    return [
        'node' => $node,
        'children' => $children
    ];
}

public function incomelevel(Request $request){
    
  $login_id = Auth::user()->memberid;
  $data=leaders_level_income::where('memberid',$login_id)->get();
  
    $data=leaders_level_income::where('memberid',$login_id)->where('level',1)->get();
    
    $data2=leaders_level_income::where('memberid',$login_id)->where('level',2)->get();

  $sum_of_level =leaders_level_income::where('memberid',$login_id)->sum('payout');
  $level1_payout=leaders_level_income::where('memberid',$login_id)->where('level',1)->sum('payout');
  $level2_payout=leaders_level_income::where('memberid',$login_id)->where('level',2)->sum('payout');
  $level3_payout=leaders_level_income::where('memberid',$login_id)->where('level',3)->sum('payout');
  
  $level1_repurchase_count=leaders_level_income::where('memberid',$login_id)->where('level',1)->sum('repurchase_count');
  $level2_repurchase_count=leaders_level_income::where('memberid',$login_id)->where('level',2)->sum('repurchase_count');
  $level3_repurchase_count=leaders_level_income::where('memberid',$login_id)->where('level',3)->sum('repurchase_count');
    
    return view('incomelevel', compact('data','data2','sum_of_level','level1_payout','level2_payout','level3_payout','level1_repurchase_count','level2_repurchase_count','level3_repurchase_count'));
}

public function incomematrix(Request $request){
    $login_id = Auth::user()->memberid;
    
    // Get selected member ID (can be login ID, rebirth ID, or repurchase ID)
    $selected_member_id = $request->input('selected_id', $login_id);
    
    // Get root member for current tree (default to selected member)
    $root_member_id = $request->input('root', $selected_member_id);
    
    // Get all related IDs for dropdown
    $related_ids = $this->getAllRelatedIds($login_id);
    
    // Validate that the selected member ID belongs to the login user
    $valid_ids = array_column($related_ids, 'memberid');
    if (!in_array($selected_member_id, $valid_ids)) {
        $selected_member_id = $login_id; // Reset to login user if invalid
        $root_member_id = $login_id;
    }
    
    // Check if user is active in the matrix tree
    $tree_status = 'inactive';
    $user_in_tree = DB::table('leaders_matrix_tree')
        ->where('memberid', $selected_member_id)
        ->first();
    $tree_status = $user_in_tree ? 'active' : 'inactive';
    
    // Get current tree data
    $tree_data = null;
    if ($tree_status === 'active') {
        $root_node = DB::table('leaders_matrix_tree')
            ->leftJoin('mlm_plan', 'leaders_matrix_tree.memberid', '=', 'mlm_plan.memberid')
            ->where('leaders_matrix_tree.memberid', $root_member_id)
            ->select('leaders_matrix_tree.*', 'mlm_plan.FullName')
            ->first();
            
        if ($root_node) {
            $tree_data = $this->getMatrixTernaryTree($root_node, 2);
        }
    }
    
    // Get matrix income data
    $data = leaders_matrix_income::where('memberid', $login_id)->get();
    
    // Get user info
    $user_info = DB::table('mlm_plan')->where('memberid', $login_id)->first();
    
    $matrix_data = [
        'tree_data' => $tree_data,
        'root_member_id' => $root_member_id,
        'selected_member_id' => $selected_member_id,
        'login_id' => $login_id,
        'tree_status' => $tree_status,
        'user_info' => $user_info,
        'income_data' => $data,
        'related_ids' => $related_ids
    ];
    
    return view('incomematrix', compact('matrix_data', 'data'));
}

public function global(Request $request){
    $login_id = Auth::user()->memberid;
    
    // Get selected member ID (can be login ID, rebirth ID, or repurchase ID)
    $selected_member_id = $request->input('selected_id', $login_id);
    
    // Get current tree number (default to 1)
    $current_tree_no = $request->input('tree_no', 1);
    
    // Get root member for current tree (default to selected member)
    $root_member_id = $request->input('root', $selected_member_id);
    
    // Get all related IDs for dropdown
    
        
     $related_ids= $this->getAllRelatedIdsForglobal_tree_rebirth($login_id);
    
    // Validate that the selected member ID belongs to the login user
    $valid_ids = array_column($related_ids, 'memberid');
    if (!in_array($selected_member_id, $valid_ids)) {
        $selected_member_id = $login_id; // Reset to login user if invalid
        $root_member_id = $login_id;
    }
    
    // Get all 5 trees status for the selected member (Global tree has 5 boards)
    $all_trees_status = [];
    for ($i = 1; $i <= 5; $i++) {
        $user_in_tree = DB::table('global_tree')
            ->where('memberid', $selected_member_id)
            ->where('tree_no', $i)
            ->first();
        $all_trees_status[$i] = $user_in_tree ? 'active' : 'inactive';
    }
    
    // Get current tree data
    $tree_data = null;
    if ($all_trees_status[$current_tree_no] === 'active') {
        $root_node = DB::table('global_tree')
            ->leftJoin('mlm_plan', 'global_tree.memberid', '=', 'mlm_plan.memberid')
            ->where('global_tree.memberid', $root_member_id)
            ->where('global_tree.tree_no', $current_tree_no)
            ->select('global_tree.*', 'mlm_plan.FullName')
            ->first();
            
        if ($root_node) {
            $tree_data = $this->getGlobalTernaryTree($root_node, $current_tree_no, 2);
        }
    }
    
    // Get user info
    $user_info = DB::table('mlm_plan')->where('memberid', $login_id)->first();
    
    
      $tbl_list = DB::table('global_bonus_income')
            ->where('global_bonus_income.memberid', $root_member_id)
            ->where('global_bonus_income.ignored', 0)
            ->where('global_bonus_income.tree_number', $current_tree_no)
            ->get();
    
    $data = [
        'tree_data' => $tree_data,
        'current_tree_no' => $current_tree_no,
        'root_member_id' => $root_member_id,
        'selected_member_id' => $selected_member_id,
        'login_id' => $login_id,
        'all_trees_status' => $all_trees_status,
        'user_info' => $user_info,
        'tbl_list' => $tbl_list,
        'related_ids' => $related_ids
    ];
    
    return view('incomeglobal', compact('data'));
}

/**
 * Check if a member is descendant of selected member in global tree
 */
private function isDescendantInGlobalTree($ancestor_id, $descendant_id, $tree_no) {
    // Get descendant node
    $descendant_node = DB::table('global_tree')
        ->where('memberid', $descendant_id)
        ->where('tree_no', $tree_no)
        ->first();
        
    if (!$descendant_node) return false;
    
    // Traverse up the tree to check if we reach the ancestor
    $current_id = $descendant_node->placement_id;
    $max_levels = 20; // Prevent infinite loops
    $levels_checked = 0;
    
    while ($current_id && $levels_checked < $max_levels) {
        if ($current_id === $ancestor_id) {
            return true;
        }
        
        $parent_node = DB::table('global_tree')
            ->where('memberid', $current_id)
            ->where('tree_no', $tree_no)
            ->first();
            
        $current_id = $parent_node ? $parent_node->placement_id : null;
        $levels_checked++;
    }
    
    return false;
}

/**
 * Build global ternary tree structure recursively
 */
private function getGlobalTernaryTree($node, $tree_no, $levels) {
    if ($levels < 0 || !$node) return null;
    
    $children = [];
    foreach (["p1", "p2", "p3"] as $pos) {
        $child = DB::table('global_tree')
            ->leftJoin('mlm_plan', 'global_tree.memberid', '=', 'mlm_plan.memberid')
            ->where('global_tree.placement_id', $node->memberid)
            ->where('global_tree.pos', $pos)
            ->where('global_tree.tree_no', $tree_no)
            ->select('global_tree.*', 'mlm_plan.FullName')
            ->first();
        $children[$pos] = $child ? $this->getGlobalTernaryTree($child, $tree_no, $levels - 1) : null;
    }
    
    return [
        'node' => $node,
        'children' => $children
    ];
}

/**
 * Build matrix ternary tree structure recursively
 */
private function getMatrixTernaryTree($node, $levels) {
    if ($levels < 0 || !$node) return null;
    
    $children = [];
    foreach (["p1", "p2", "p3"] as $pos) {
        $child = DB::table('leaders_matrix_tree')
            ->leftJoin('mlm_plan', 'leaders_matrix_tree.memberid', '=', 'mlm_plan.memberid')
            ->where('leaders_matrix_tree.placement_id', $node->memberid)
            ->where('leaders_matrix_tree.pos', $pos)
            ->select('leaders_matrix_tree.*', 'mlm_plan.FullName')
            ->first();
        $children[$pos] = $child ? $this->getMatrixTernaryTree($child, $levels - 1) : null;
    }
    
    return [
        'node' => $node,
        'children' => $children
    ];
}
public function fast(Request $request){
    $login_id = Auth::user()->memberid;
    
    // Get selected member ID (can be login ID, rebirth ID, or repurchase ID)
    $selected_member_id = $request->input('selected_id', $login_id);
    
    // Get current tree number (default to 1)
    $current_tree_no = $request->input('tree_no', 1);
    
    // Get root member for current tree (default to selected member)
    $root_member_id = $request->input('root', $selected_member_id);
    
    // Get all related IDs for dropdown (including fast_track_rebirth for Fast Track page)
    $related_ids = $this->getAllRelatedIdsForFastTrack($login_id);
    
    // Add board payout sums for each related ID
    foreach ($related_ids as &$id_info) {
        // Get Board 1 payout sum
        $board1_payout = DB::table('fast_track_income')
            ->where('memberid', $id_info['memberid'])
            ->where('tree_number', 1)
            ->sum('payout');
        $id_info['board1_payout'] = $board1_payout ?? 0;
        
        // Get Board 2 payout sum
        $board2_payout = DB::table('fast_track_income')
            ->where('memberid', $id_info['memberid'])
            ->where('tree_number', 2)
            ->sum('payout');
        $id_info['board2_payout'] = $board2_payout ?? 0;
    }
    
    // Validate that the selected member ID belongs to the login user
    $valid_ids = array_column($related_ids, 'memberid');
    if (!in_array($selected_member_id, $valid_ids)) {
        $selected_member_id = $login_id; // Reset to login user if invalid
        $root_member_id = $login_id;
    }
    
    // Validate that the requested root is a descendant of selected member (security check)
    if ($root_member_id !== $selected_member_id) {
        $is_descendant = $this->isDescendantInFastTrackTree($selected_member_id, $root_member_id, $current_tree_no);
        if (!$is_descendant) {
            $root_member_id = $selected_member_id; // Reset to selected member if not a descendant
        }
    }
    
    // Get both trees status for the selected member (Fast Track has 2 boards)
    $all_trees_status = [];
    for ($i = 1; $i <= 2; $i++) {
        $user_in_tree = DB::table('fast_track_tree')
            ->where('memberid', $selected_member_id)
            ->where('tree_no', $i)
            ->first();
        $all_trees_status[$i] = $user_in_tree ? 'active' : 'inactive';
    }
    
    // Get current tree data
    $tree_data = null;
    if ($all_trees_status[$current_tree_no] === 'active') {
        $root_node = DB::table('fast_track_tree')
            ->leftJoin('mlm_plan', 'fast_track_tree.memberid', '=', 'mlm_plan.memberid')
            ->where('fast_track_tree.memberid', $root_member_id)
            ->where('fast_track_tree.tree_no', $current_tree_no)
            ->select('fast_track_tree.*', 'mlm_plan.FullName')
            ->first();
            
        if ($root_node) {
            $tree_data = $this->getFastTrackTernaryTree($root_node, $current_tree_no, 1); // Only 1 level deep for 3 direct children
        }
    }
    
    // Get Fast Track income data
    $fast_track_income = $this->getFastTrackIncomeData($selected_member_id);
    
    // Get user info
    $user_info = DB::table('mlm_plan')->where('memberid', $login_id)->first();
    
    $data = [
        'tree_data' => $tree_data,
        'current_tree_no' => $current_tree_no,
        'root_member_id' => $root_member_id,
        'selected_member_id' => $selected_member_id,
        'login_id' => $login_id,
        'all_trees_status' => $all_trees_status,
        'user_info' => $user_info,
        'related_ids' => $related_ids,
        'fast_track_income' => $fast_track_income
    ];
    
    return view('incomefast', compact('data'));
}

/**
 * Check if a member is descendant of selected member in fast track tree
 */
private function isDescendantInFastTrackTree($ancestor_id, $descendant_id, $tree_no) {
    // Get descendant node
    $descendant_node = DB::table('fast_track_tree')
        ->where('memberid', $descendant_id)
        ->where('tree_no', $tree_no)
        ->first();
        
    if (!$descendant_node) return false;
    
    // Traverse up the tree to check if we reach the ancestor
    $current_id = $descendant_node->placement_id;
    $max_levels = 20; // Prevent infinite loops
    $levels_checked = 0;
    
    while ($current_id && $levels_checked < $max_levels) {
        if ($current_id === $ancestor_id) {
            return true;
        }
        
        $parent_node = DB::table('fast_track_tree')
            ->where('memberid', $current_id)
            ->where('tree_no', $tree_no)
            ->first();
            
        $current_id = $parent_node ? $parent_node->placement_id : null;
        $levels_checked++;
    }
    
    return false;
}

/**
 * Build fast track ternary tree structure recursively (only 3 direct children)
 */
private function getFastTrackTernaryTree($node, $tree_no, $levels) {
    if ($levels < 0 || !$node) return null;
    
    $children = [];
    foreach (["p1", "p2", "p3"] as $pos) {
        $child = DB::table('fast_track_tree')
            ->leftJoin('mlm_plan', 'fast_track_tree.memberid', '=', 'mlm_plan.memberid')
            ->where('fast_track_tree.placement_id', $node->memberid)
            ->where('fast_track_tree.pos', $pos)
            ->where('fast_track_tree.tree_no', $tree_no)
            ->select('fast_track_tree.*', 'mlm_plan.FullName')
            ->first();
        $children[$pos] = $child ? $this->getFastTrackTernaryTree($child, $tree_no, $levels - 1) : null;
    }
    
    return [
        'node' => $node,
        'children' => $children
    ];
}

/**
 * Get Fast Track income data
 */
private function getFastTrackIncomeData($member_id) {
    // Get Fast Track income for both boards
    $board1_income = DB::table('fast_track_income')
        ->where('memberid', $member_id)
        ->where('tree_number', 1)
        ->sum('payout') ?? 0;
        
    $board2_income = DB::table('fast_track_income')
        ->where('memberid', $member_id)
        ->where('tree_number', 2)
        ->sum('payout') ?? 0;
        
    $total_income = $board1_income + $board2_income;
    
    // Get rebirth count (count of rebirth IDs)
    $rebirth_count = DB::table('mlm_plan')
        ->where('original_id', $member_id)
        ->where('memberid_type', 'rebirth')
        ->count();
    
    return [
        'board1_income' => $board1_income,
        'board2_income' => $board2_income,
        'total_income' => $total_income,
        'rebirth_count' => $rebirth_count
    ];
}

public function achieve(Request $request){

    $login_id = Auth::user()->memberid;

    // dd($login_id);
    
    // Get selected member ID (can be login ID, rebirth ID, or repurchase ID)
    $selected_member_id = $request->input('selected_id', $login_id);
    
    // Get root member for current tree (default to selected member)
    $root_member_id = $request->input('root', $selected_member_id);
    
    // Get all related IDs for dropdown
    $related_ids = $this->getAllRelatedIds($login_id);
    
    // Validate that the selected member ID belongs to the login user
    $valid_ids = array_column($related_ids, 'memberid');
    if (!in_array($selected_member_id, $valid_ids)) {
        $selected_member_id = $login_id; // Reset to login user if invalid
        $root_member_id = $login_id;
    }
    
    // Validate that the requested root is a descendant of selected member (security check)
    if ($root_member_id !== $selected_member_id) {
        $is_descendant = $this->isDescendantInAchievementTree($selected_member_id, $root_member_id);
        if (!$is_descendant) {
            $root_member_id = $selected_member_id; // Reset to selected member if not a descendant
        }
    }
    
    // Check if selected member has achievement tree active (Achievement tree has only 1 board)
    $user_in_tree = DB::table('achievement_tree')
        ->where('memberid', $selected_member_id)
        ->first();
    $tree_active = $user_in_tree ? true : false;
    
    // Get achievement tree data
    $tree_data = null;
    if ($tree_active) {

        $root_node = DB::table('achievement_tree')
            ->leftJoin('mlm_plan', 'achievement_tree.memberid', '=', 'mlm_plan.memberid')
            ->where('achievement_tree.memberid', $root_member_id)
            ->select('achievement_tree.*', 'mlm_plan.FullName')
            ->first();
            
        if ($root_node) {
            $tree_data = $this->getAchievementTernaryTree($root_node, 2);
        }
    }
    
    // Get achievement levels data for the selected member
    $achievement_levels = $this->getAchievementLevelsData($selected_member_id);
    
    // Get user info
    $user_info = DB::table('mlm_plan')->where('memberid', $login_id)->first();
    
    $data = [
        'tree_data' => $tree_data,
        'tree_active' => $tree_active,
        'root_member_id' => $root_member_id,
        'selected_member_id' => $selected_member_id,
        'login_id' => $login_id,
        'user_info' => $user_info,
        'related_ids' => $related_ids,
        'achievement_levels' => $achievement_levels
    ];
    
    return view('incomeachieve', compact('data'));
}

/**
 * Check if a member is descendant of selected member in achievement tree
 */
private function isDescendantInAchievementTree($ancestor_id, $descendant_id) {
    // Get descendant node
    $descendant_node = DB::table('achievement_tree')
        ->where('memberid', $descendant_id)
        ->first();
        
    if (!$descendant_node) return false;
    
    // Traverse up the tree to check if we reach the ancestor
    $current_id = $descendant_node->placement_id;
    $max_levels = 20; // Prevent infinite loops
    $levels_checked = 0;
    
    while ($current_id && $levels_checked < $max_levels) {
        if ($current_id === $ancestor_id) {
            return true;
        }
        
        $parent_node = DB::table('achievement_tree')
            ->where('memberid', $current_id)
            ->first();
            
        $current_id = $parent_node ? $parent_node->placement_id : null;
        $levels_checked++;
    }
    
    return false;
}

/**
 * Build achievement ternary tree structure recursively
 */
private function getAchievementTernaryTree($node, $levels) {
    if ($levels < 0 || !$node) return null;
    
    $children = [];
    foreach (["p1", "p2", "p3"] as $pos) {
        $child = DB::table('achievement_tree')
            ->leftJoin('mlm_plan', 'achievement_tree.memberid', '=', 'mlm_plan.memberid')
            ->where('achievement_tree.placement_id', $node->memberid)
            ->where('achievement_tree.pos', $pos)
            ->select('achievement_tree.*', 'mlm_plan.FullName')
            ->first();
        $children[$pos] = $child ? $this->getAchievementTernaryTree($child, $levels - 1) : null;
    }
    
    return [
        'node' => $node,
        'children' => $children
    ];
}

/**
 * Get achievement levels data for display
 */
private function getAchievementLevelsData($member_id) {
    // Define achievement level structure (from IncomeController)
    $level_definitions = [
        6 => ['amount' => 1000, 'target' => 729],        // Level 6: ₹1,000/month, 729 members target
        7 => ['amount' => 2000, 'target' => 2187],       // Level 7: ₹2,000/month, 2,187 members target
        8 => ['amount' => 4000, 'target' => 6561],       // Level 8: ₹4,000/month, 6,561 members target
        9 => ['amount' => 8000, 'target' => 19683],      // Level 9: ₹8,000/month, 19,683 members target
        10 => ['amount' => 25000, 'target' => 59049],    // Level 10: ₹25,000/month, 59,049 members target
        11 => ['amount' => 75000, 'target' => 177147],   // Level 11: ₹75,000/month, 177,147 members target
        12 => ['amount' => 125000, 'target' => 531441],  // Level 12: ₹125,000/month, 531,441 members target
        13 => ['amount' => 400000, 'target' => 1594323], // Level 13: ₹400,000/month, 1,594,323 members target
        14 => ['amount' => 1000000, 'target' => 4782969] // Level 14: ₹1,000,000/month, 4,782,969 members target
    ];
    
    $achievement_data = [];
    $total_earned = 0;
    $today = date('Y-m-d');
    
    foreach ($level_definitions as $level => $level_info) {
        // Get achievement income records for this level where eldate <= today
        $eligible_incomes = achievement_level_income::where('memberid', $member_id)
            ->where('level', $level)
            ->where('eldate', '<=', $today)
            ->get();
        
        $bonuses_earned = $eligible_incomes->count();
        $total_amount_for_level = $eligible_incomes->sum('payout');
        $total_earned += $total_amount_for_level;
        
        // Get actual member count for this level (using existing helper function)
        $actual_count = $this->getDownlineMembersCount($member_id, $level);
        
        // Include all levels (even with 0 income)
        $achievement_data[$level] = [
            'level' => $level,
            'amount_per_bonus' => $level_info['amount'],
            'bonuses_earned' => $bonuses_earned,
            'total_amount' => $total_amount_for_level,
            'target' => $level_info['target'],
            'actual' => $actual_count
        ];
    }
    
    return [
        'levels' => $achievement_data,
        'total_earned' => $total_earned
    ];
}

/**
 * Get count of downline members at specific level in ternary tree
 * Level 1 = direct children, Level 2 = grandchildren, etc.
 */
private function getDownlineMembersCount($member_id, $level) {
    if ($level <= 0) return 0;
    
    // Start with the given member as the root (level 0)
    $current_level_nodes = [$member_id];
    
    // Navigate down the tree level by level
    for ($current_level = 1; $current_level <= $level; $current_level++) {
        $next_level_nodes = [];
        
        // For each node in current level, find their children
        foreach ($current_level_nodes as $parent_id) {
            $children = DB::table('achievement_tree')
                ->where('placement_id', $parent_id)
                ->whereIn('pos', ['p1', 'p2', 'p3'])
                ->pluck('memberid')
                ->toArray();
            
            $next_level_nodes = array_merge($next_level_nodes, $children);
        }
        
        // If we've reached the target level, return the count
        if ($current_level == $level) {
            return count($next_level_nodes);
        }
        
        // If no children found, no deeper levels exist
        if (empty($next_level_nodes)) {
            return 0;
        }
        
        // Move to next level
        $current_level_nodes = $next_level_nodes;
    }
    
    return 0;
}

public function repurlevel(Request $request){
    
    $login_id = Auth::user()->memberid;
    $level=[];
    $incomes=[];
    $count=0;
    $sum=0;
    $selected_member_id = $request->input('selected_id');
    
    $related_ids_collection = repurchase_cutoff_slots::get();
    
    // Convert to array format expected by view
    $related_ids = [];
    foreach ($related_ids_collection as $cutoff_slot) {
        $related_ids[] = [
            'id' => $cutoff_slot->id,
            'name' => $cutoff_slot->name
        ];
    }
     
    if($selected_member_id){ 
        $incomes = repurchase_level_income::where('cutoff_slot_id', $selected_member_id)
        ->where('memberid', $login_id)
        ->get();  
    }else{
        $incomes = repurchase_level_income::where('memberid', $login_id)->get();
    }

    // Group the records by level
    $groupedByLevel = $incomes->groupBy('level');
    
    $level_data = [];
    $total_count = 0;
    $total_sum = 0;

    foreach ($groupedByLevel as $level_num => $records) {
        $count = $records->count();
        $sum = $records->sum('payout');
        
        $level_data[] = [
            'level' => $level_num,
            'count' => $count,
            'amount' => round($sum, 2)
        ];
        
        $total_count += $count;
        $total_sum += $sum;
    }

    // dd($level_data);
    
    $data = [
        'level' => $level_data,
        'count' => $total_count,
        'total_amount' => round($total_sum, 2),
        'selected_member_id' => $selected_member_id,
        'login_id' => $login_id,
        'related_ids' => $related_ids
    ];


    $repurchase_members = DB::table('mlm_plan as rp')
        ->leftJoin('mlm_plan as owner', 'rp.all_father_id', '=', 'owner.memberid')
        ->leftJoin('plan_activation_queue as paq', 'rp.memberid', '=', 'paq.activation_id')
        ->where('rp.memberid_type', 'repurchase')
        ->select(
            'rp.memberid as rp_id',
            'rp.all_father_id',
            'owner.FullName as owner_name',
            'owner.memberid as owner_memberid',
            'paq.created_at as activation_date',
            'paq.activation_status'
        )
        ->where('owner.memberid',$login_id)
        ->orderBy('rp.created_at', 'desc')
        ->get();


    // dd($data);
    
    return view('incomerepurlevel', compact('data','repurchase_members'));
    
}

 public function referrals_with_repurchases_report(Request $request)
{
    try {
        // Get all regular members to analyze
        $members = mlm_plan::where('memberid_type', 'regular')
            ->where('status', 1)
            ->orderBy('memberid', 'asc')
            ->get();

        $reportData = [];
        
        foreach ($members as $member) {
            // Get all direct referrals for this member (using sponsor_id)
            $referrals = mlm_plan::where('sponsor_id', $member->memberid)
                ->where('memberid_type', 'regular')
                ->where('status', 1)
                ->get();

            foreach ($referrals as $referral) {
                // Count repurchase IDs generated by this referral
                // Using all_father_id to track repurchases back to the original member
                $repurchaseCount = mlm_plan::where('all_father_id', $referral->memberid)
                    ->where('memberid_type', 'repurchase')
                    ->where('status', 1)
                    ->count();

                // Only include referrals with more than 2 repurchase IDs
                if ($repurchaseCount > 2) {
                    // Get the repurchase IDs for display
                    $repurchaseIds = mlm_plan::where('all_father_id', $referral->memberid)
                        ->where('memberid_type', 'repurchase')
                        ->where('status', 1)
                        ->pluck('memberid')
                        ->toArray();

                    $reportData[] = [
                        'sponsor_id' => $member->memberid,
                        'sponsor_name' => $member->FullName,
                        'referral_id' => $referral->memberid,
                        'referral_name' => $referral->FullName,
                        'referral_join_date' => $referral->created_at->format('Y-m-d'),
                        'repurchase_count' => $repurchaseCount,
                        'repurchase_ids' => $repurchaseIds,
                        'latest_repurchase_date' => mlm_plan::where('all_father_id', $referral->memberid)
                            ->where('memberid_type', 'repurchase')
                            ->where('status', 1)
                            ->max('created_at')
                    ];
                }
            }
        }

        // Sort by repurchase count (descending)
        usort($reportData, function($a, $b) {
            return $b['repurchase_count'] - $a['repurchase_count'];
        });

        // Prepare data for the view
       return $data = [
            'report_data' => $reportData,
            'total_qualifying_referrals' => count($reportData),
            'total_repurchases' => array_sum(array_column($reportData, 'repurchase_count')),
            'generated_at' => now()->format('Y-m-d H:i:s')
        ];

        return view('referrals_repurchase_report', compact('data'));

    } catch (\Exception $e) {
        return back()->with('error', 'Error generating report: ' . $e->getMessage());
    }
}

}
