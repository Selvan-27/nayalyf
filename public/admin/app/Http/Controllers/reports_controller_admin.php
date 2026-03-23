<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Services\WalletService;

// Models
use App\Models\Product_stocks;
use App\Models\Product;
use App\Models\Category;
use App\Models\Orders_items;
use App\Models\User;    
use App\Models\mlm_plan;
use App\Models\withdraw_history;
use App\Models\Orders;
use App\Models\topupdetails;
use App\Models\plan_activation_queue;
use App\Models\fast_track_income;

class reports_controller_admin extends Controller
{
public function board_1(){ $data = []; return view('welcome', compact('data')); }
public function admin_home(Request $request){

        $products_total=Product::where('type','products')->where('is_active',1)->where('id','>',5)->count();
        $from_date = $request->from_date;
$to_date   = $request->to_date;

// Base query
$query = Orders_items::query();

// Apply date filter only if both are set
if (!empty($from_date) && !empty($to_date)) {
    $query->whereBetween('created_at', [$from_date, $to_date]);
}

// Starter kits
$starter_kits = (clone $query)->where('product_id', 2)->sum('price');
$starter_kits_count = (clone $query)->where('product_id', 2)->sum('quantity');

// ID cards
$id_card = (clone $query)->where('product_id', 1)->sum('price');
$id_card_count = (clone $query)->where('product_id', 1)->sum('quantity');

// Repurchase
$repurchase = (clone $query)->where('product_id', '>', 2)->sum('price');
$repurchase_count = (clone $query)->where('product_id', '>', 2)->sum('quantity');
    
    return view('home', compact('products_total','starter_kits','starter_kits_count','id_card','id_card_count','repurchase','repurchase_count')); 

}
public function members_list(){ $data = []; return view('memlist', compact('data')); }
public function members_deposit_list(){ $data = []; return view('memdeplist', compact('data')); }

public function members_income_list(Request $request){ 
    
    // Get date filters from request
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    
    // Base query for users with MLM plan - get all members
    $members = DB::table('users')
        ->join('mlm_plan', 'users.memberid', '=', 'mlm_plan.memberid')
        ->select(
            'users.id',
            'users.name', 
            'users.memberid',
            'users.created_at as signup_date',
            'mlm_plan.sponsor_id'
        )
        ->get();
    
    // Calculate income data for each member with date filtering
    $membersData = $members->map(function($member) use ($fromDate, $toDate) {
        // Get referral count (direct referrals)
        $referralCount = DB::table('mlm_plan')
            ->where('sponsor_id', $member->id)
            ->where('memberid_type', 'regular')
            ->count();
        
        // Get total referrals needed (assuming 8 based on view)
        $totalReferralsNeeded = 8;
        
        // Helper function to apply date filters to income queries
        $applyDateFilter = function($query) use ($fromDate, $toDate) {
            if ($fromDate) {
                $query->whereDate('created_at', '>=', $fromDate);
            }
            if ($toDate) {
                $query->whereDate('created_at', '<=', $toDate);
            }
            return $query;
        };
        
        // Get Sales Incentive (unique_incentive_income) with date filter
        $salesIncentiveQuery = DB::table('unique_incentive_income')->where('memberid', $member->memberid);
        $salesIncentive = $applyDateFilter($salesIncentiveQuery)->sum('payout') ?? 0;
        
        // Get Ignite Bonus (referral income) with date filter
        $igniteQuery = DB::table('referral_income')->where('memberid', $member->memberid);
        $igniteBonus = $applyDateFilter($igniteQuery)->sum('payout') ?? 0;
        
        // Get Re-Ignite Bonus with date filter
        $reIgniteQuery = DB::table('re_ignite_income')->where('memberid', $member->memberid);
        $reIgniteBonus = $applyDateFilter($reIgniteQuery)->sum('payout') ?? 0;
        
        // Get Team Performance Bonus with date filter
        $teamPerformanceQuery = DB::table('team_performance_income')->where('memberid', $member->memberid)
        ->where('ignored', 0);
        $teamPerformanceBonus = $applyDateFilter($teamPerformanceQuery)->sum('payout') ?? 0;
        
        // Get Global Bonus with date filter
        $globalQuery = DB::table('global_bonus_income')->where('memberid', $member->memberid)
        ->where('ignored', 0);
        $globalBonus = $applyDateFilter($globalQuery)->sum('payout') ?? 0;
        
        // Get Fast Track Bonus with date filter
        $fastTrackQuery = DB::table('fast_track_income')->where('memberid', $member->memberid);
        $fastTrackBonus = $applyDateFilter($fastTrackQuery)->sum('payout') ?? 0;


        $totals = fast_track_income::where('memberid', $member->memberid)
    ->orWhereRaw('FIND_IN_SET(?, all_father_id)', [$member->memberid])
    ->selectRaw('ROUND(COALESCE(SUM(payout),0),2) as fast_track_payout,
                 ROUND(COALESCE(SUM(netpay),0),2) as fast_track_netpay')
    ->first();

$fast_track_payout = (float) ($totals->fast_track_payout ?? 0);
$fast_track_netpay = (float) ($totals->fast_track_netpay ?? 0);

$fastTrackBonus= $fast_track_payout;
        
        // Get Achievement Bonus with date filter
        $achievementQuery = DB::table('achievement_level_income')->where('memberid', $member->memberid);
        $achievementBonus = $applyDateFilter($achievementQuery)->sum('payout') ?? 0;
        
        // Get Repurchase Bonus with date filter
        $repurchaseQuery = DB::table('repurchase_level_income')->where('memberid', $member->memberid);
        $repurchaseBonus = $applyDateFilter($repurchaseQuery)->sum('payout') ?? 0;
        
        // Get Leader Level Bonus with date filter
        $leaderLevelQuery = DB::table('leaders_level_income')->where('memberid', $member->memberid);
        $leaderLevelBonus = $applyDateFilter($leaderLevelQuery)->sum('payout') ?? 0;
        
        // Get Leader Matrix Bonus with date filter
        $leaderMatrixQuery = DB::table('leaders_matrix_income')->where('memberid', $member->memberid);
        $leaderMatrixBonus = $applyDateFilter($leaderMatrixQuery)->sum('payout') ?? 0;
        
        // Calculate total income
        $totalIncome = $salesIncentive + $igniteBonus + $reIgniteBonus + $teamPerformanceBonus + 
                      $globalBonus + $fastTrackBonus + $achievementBonus + $repurchaseBonus + 
                      $leaderLevelBonus + $leaderMatrixBonus;
        
        // Get withdrawal payout with date filter
        $withdrawQuery = DB::table('withdraw_history')
            ->where('memberid', $member->memberid)
            ->where(function($query) {
                $query->where('status', 'success')
                      ->orWhere('status', 'pending')
                      ->orWhere('status', 'processing');
            });

    //         $total_withdraw = round(withdraw_history::where('memberid', $memberid)
    // ->where(function($query) {
    //     $query->where('status', 'success')
    //           ->orWhere('status', 'pending')
    //           ->orWhere('status', 'processing');
    // })
    // ->sum('payout'), 2);

        $withdrawpayout = $applyDateFilter($withdrawQuery)->sum('payout') ?? 0;


           $from_income_wallet = round(
        Orders::where('user_id', $member->memberid)
            ->where('status', '!=', 'cancelled')
            ->sum('from_income_wallet'),
        2
    );


      $activation = plan_activation_queue::where('login_id', $member->memberid)->where('activation_id', 'like', 'UC%')->where('activation_status', 'success')->count();
     $activation_amt=$activation*1600;
 

     $topup_amount = round(topupdetails::where('loginid', $member->memberid)->sum('amount'), 2);

        // Calculate wallet balance
        $walletBalance = $totalIncome - $withdrawpayout - $from_income_wallet - $topup_amount;
        
        return [
            'id' => $member->id,
            'name' => $member->name,
            'memberid' => $member->memberid,
            'signup_date' => $member->signup_date,
            'activation_date' => $member->signup_date, // Using signup_date as activation_date doesn't exist
            'referral_count' => $referralCount,
            'total_referrals_needed' => $totalReferralsNeeded,
            'sales_incentive' => $salesIncentive,
            'ignite_bonus' => $igniteBonus,
            're_ignite_bonus' => $reIgniteBonus,
            'team_performance_bonus' => $teamPerformanceBonus,
            'global_bonus' => $globalBonus,
            'fast_track_bonus' => $fastTrackBonus,
            'achievement_bonus' => $achievementBonus,
            'repurchase_bonus' => $repurchaseBonus,
            'leader_level_bonus' => $leaderLevelBonus,
            'leader_matrix_bonus' => $leaderMatrixBonus,
            'total_income' => $totalIncome,
            'withdraw_payout' => $withdrawpayout,
            'from_income_wallet' => $from_income_wallet,
            'activation_amt' => $activation_amt,
            'wallet_balance' => $walletBalance
        ];
    });

   

    $data = [
        'members' => $membersData,
        'from_date' => $fromDate,
        'to_date' => $toDate
    ]; 



    return view('meminclist', compact('data'));

}

public function members_create(){ $data = []; return view('memadd', compact('data')); }
public function members_activate(){ $data = []; return view('memact', compact('data')); }   
public function incentive_fix(){ $data = []; return view('incentive_fix', compact('data')); }   
public function members_details(Request $request, WalletService $walletService){ 
    
    $member_id = $request->input('member_id');
    $memberData = $walletService->get_member_details($member_id);
    
    $data = [
        'member_id' => $member_id,
        'memberData' => $memberData
    ]; 
    
    return view('memdetail', compact('data')); 

} 
public function members_edit(){ $data = []; return view('memedit', compact('data')); } 
public function members_rebirth_list(){ 
    // Fetch rebirth members from mlm_plan table
    $rebirth_members = DB::table('mlm_plan as rb')
        ->leftJoin('mlm_plan as owner', 'rb.all_father_id', '=', 'owner.memberid')
        ->leftJoin('plan_activation_queue as paq', 'rb.memberid', '=', 'paq.activation_id')
        ->where('rb.memberid_type', 'rebirth')
        ->select(
            'rb.memberid as rb_id',
            'rb.all_father_id',
            'owner.FullName as owner_name',
            'owner.memberid as owner_memberid',
            'paq.created_at as activation_date',
            'paq.activation_status'
        )
        ->orderBy('rb.created_at', 'desc')
        ->get();

    // Calculate income for each rebirth member
    $rebirth_members = $rebirth_members->map(function($member) {
        // Get Re-Ignite Bonus
        $reIgniteBonus = DB::table('re_ignite_income')
            ->where('memberid', $member->rb_id)
            ->sum('payout') ?? 0;
        
        // Get Team Performance Bonus
        $teamPerformanceBonus = DB::table('team_performance_income')
            ->where('memberid', $member->rb_id)
            ->where('ignored', 0)
            ->sum('payout') ?? 0;
        
        // Get Global Bonus
        $globalBonus = DB::table('global_bonus_income')
            ->where('memberid', $member->rb_id)
            ->where('ignored', 0)
            ->sum('payout') ?? 0;
        
        // Get Fast Track Bonus
        $fastTrackBonus = DB::table('fast_track_income')
            ->where('memberid', $member->rb_id)
            ->sum('payout') ?? 0;
        
        // Calculate total income
        $totalIncome = $reIgniteBonus + $teamPerformanceBonus + $globalBonus + $fastTrackBonus;
        
        $member->re_ignite_bonus = $reIgniteBonus;
        $member->team_performance_bonus = $teamPerformanceBonus;
        $member->global_bonus = $globalBonus;
        $member->fast_track_bonus = $fastTrackBonus;
        $member->total_income = $totalIncome;
        
        return $member;
    });

    $data = [
        'rebirth_members' => $rebirth_members
    ]; 
    
    return view('memrblist', compact('data')); 
}
public function members_repurchase_id_list(){ 
    // Fetch repurchase members from mlm_plan table
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
        ->orderBy('rp.created_at', 'desc')
        ->get();

    // Calculate income for each repurchase member
    $repurchase_members = $repurchase_members->map(function($member) {
        // Get Team Performance Bonus
        $teamPerformanceBonus = DB::table('team_performance_income')
            ->where('memberid', $member->rp_id)
            ->where('ignored', 0)
            ->sum('payout') ?? 0;
        
        // Get Global Bonus
        $globalBonus = DB::table('global_bonus_income')
            ->where('memberid', $member->rp_id)
            ->where('ignored', 0)
            ->sum('payout') ?? 0;
        
        // Get Fast Track Bonus
        $fastTrackBonus = DB::table('fast_track_income')
            ->where('memberid', $member->rp_id)
            ->sum('payout') ?? 0;
        
        // Calculate total income
        $totalIncome = $teamPerformanceBonus + $globalBonus + $fastTrackBonus;
        
        $member->team_performance_bonus = $teamPerformanceBonus;
        $member->global_bonus = $globalBonus;
        $member->fast_track_bonus = $fastTrackBonus;
        $member->total_income = $totalIncome;
        
        return $member;
    });

    $data = [
        'repurchase_members' => $repurchase_members
    ]; 
    
    return view('memrplist', compact('data')); 
} 
public function members_fasttrack_id_list(){ 
    // Get unique member IDs from fast_track_tree table first
    $unique_memberids = DB::table('fast_track_tree')
        ->select('memberid')
        ->distinct()
        ->pluck('memberid');

    // Fetch fast track members data for unique member IDs
    $fast_track_members = collect();
    
    foreach($unique_memberids as $memberid) {
        // Get the first record for this member ID to get creation date
        $ft_record = DB::table('fast_track_tree')
            ->where('memberid', $memberid)
            ->orderBy('created_at', 'asc')
            ->first();
            
        // Get owner information
        $owner = DB::table('mlm_plan')
            ->where('memberid', $memberid)
            ->first();
            
        if($ft_record) {
            $member = (object)[
                'ft_id' => $memberid,
                'ft_active_date' => $ft_record->created_at,
                'owner_id' => $owner->original_id ?? null,
                'owner_name' => $owner->FullName ?? null
            ];
            
            $fast_track_members->push($member);
        }
    }

    // Calculate income and rebirth data for each fast track member
    $fast_track_members = $fast_track_members->map(function($member) {
        // Get Fast Track 1 Bonus (tree_number = 1)
        $fastTrack1Query = DB::table('fast_track_income')
            ->where('memberid', $member->ft_id)
            ->where('tree_number', 1);
        
        $fastTrack1Bonus = $fastTrack1Query->sum('payout') ?? 0;
        $fastTrack1Date = $fastTrack1Query->first()?->created_at ?? null;
        
        // Get Fast Track 2 Bonus (tree_number = 2)
        $fastTrack2Query = DB::table('fast_track_income')
            ->where('memberid', $member->ft_id)
            ->where('tree_number', 2);
        
        $fastTrack2Bonus = $fastTrack2Query->sum('payout') ?? 0;
        $fastTrack2Date = $fastTrack2Query->first()?->created_at ?? null;
        
        // Calculate total income
        $totalIncome = $fastTrack1Bonus + $fastTrack2Bonus;
        
        // Get FT Rebirths (fast_track_rebirth members with this FT ID)
        $ftRebirths = DB::table('mlm_plan')
            ->where('memberid', $member->ft_id)
            ->where('memberid_type', 'fast_track_rebirth')
            ->pluck('memberid')
            ->toArray();
        
        $member->fast_track_1_bonus = $fastTrack1Bonus;
        $member->fast_track_1_date = $fastTrack1Date;
        $member->fast_track_2_bonus = $fastTrack2Bonus;
        $member->fast_track_2_date = $fastTrack2Date;
        $member->total_income = $totalIncome;
        $member->ft_rebirths = $ftRebirths;
        
        return $member;
    });

    // Sort by ft_active_date descending
    $fast_track_members = $fast_track_members->sortByDesc('ft_active_date')->values();

    $data = [
        'fast_track_members' => $fast_track_members
    ]; 
    
    return view('memftlist', compact('data')); 
}  

public function members_orders_list(){ $data = []; return view('memorder', compact('data')); } 
public function members_kit_list(){ $data = []; return view('memorderwel', compact('data')); } 
public function members_card_list(){ $data = []; return view('memordercard', compact('data')); } 
public function members_returns_list(){ $data = []; return view('memreturn', compact('data')); }  

public function product_list(){ $data = []; return view('prolist', compact('data')); }
public function product_add(){ $data = []; return view('proadd', compact('data')); }
public function product_stock(){ $data = []; return view('prostock', compact('data')); }
public function category_add(){ $data = []; return view('procat', compact('data')); }

public function sales_product(){ $data = []; return view('salepro', compact('data')); }
public function sales_day(){ $data = []; return view('saleday', compact('data')); }

public function flash_sale(){ $data = []; return view('offerflash', compact('data')); }
public function cutoff_sale(){ $data = []; return view('offercut', compact('data')); }

public function incentive(Request $request){ 
    // Get date filters from request
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    
    try {
        // Base query for unique_incentive_income with joins to get member names
        $query = DB::table('unique_incentive_income as uii')
            ->leftJoin('users as from_user', 'uii.fromId', '=', 'from_user.memberid')
            ->leftJoin('users as to_user', 'uii.memberid', '=', 'to_user.memberid')
            ->select(
                'uii.*',
                'from_user.name as fname',
                'to_user.name as tname'
            );
        
        // Apply date filter if provided
        if ($fromDate) {
            $query->whereDate('uii.created_at', '>=', $fromDate);
        }
        if ($toDate) {
            $query->whereDate('uii.created_at', '<=', $toDate);
        }
        
        // Order by creation date descending
        $data = $query->orderBy('uii.created_at', 'desc')->get();
        
    } catch (\Exception $e) {
        // Fallback: if table doesn't exist or query fails, return empty data
        $data = collect([]);
    }
    
    return view('incentive', compact('data')); 
}



public function ignite_list(){ $data = []; return view('refinlist', compact('data')); }
public function reignite_list(){ $data = []; return view('rbinlist', compact('data')); }
public function team_performance_list(){ $data = []; return view('tpinlist', compact('data')); }
public function global_list(){ $data = []; return view('ginlist', compact('data')); }
public function fasttrack_list(){ $data = []; return view('ftinlist', compact('data')); }
public function achievement_list(){ $data = []; return view('ainlist', compact('data')); }
public function repurchase_list(){ $data = []; return view('rlinlist', compact('data')); }

public function team_tree(){ $data = []; return view('treeown', compact('data')); }

public function team_per_tree(Request $request) {
    // For each board (tree_no 1-15), get the root node (from mlm_plan or from ?root=)
    $all_trees = [];
    for ($tree_no = 1; $tree_no <= 15; $tree_no++) {
        $root = $request->input('root_' . $tree_no);
        if (!$root) {
            // Get first memberid from mlm_plan as root for this board
            $root = DB::table('mlm_plan')->orderBy('id')->value('memberid');
        }
        // Fetch the root node for this board
        $root_node = DB::table('team_performance_tree')
            ->where('memberid', $root)
            ->where('tree_no', $tree_no)
            ->first();
        // If not found, skip this board
        if (!$root_node) {
            $all_trees[$tree_no] = null;
            continue;
        }
        // Recursively fetch up to 3 levels (root + 2 child levels)
        $tree = $this->getTernaryTree($root_node, $tree_no, 2);
        $all_trees[$tree_no] = $tree;
    }
    return view('treeteam', ['all_trees' => $all_trees]);
}

// Helper to build ternary tree up to $levels
private function getTernaryTree($node, $tree_no, $levels) {
    if ($levels < 0 || !$node) return null;
    $children = [];
    foreach (["p1", "p2", "p3"] as $pos) {
        $child = DB::table('team_performance_tree')
            ->where('placement_id', $node->memberid)
            ->where('pos', $pos)
            ->where('tree_no', $tree_no)
            ->first();
        $children[$pos] = $child ? $this->getTernaryTree($child, $tree_no, $levels - 1) : null;
    }
    return [
        'node' => $node,
        'children' => $children
    ];
}

public function global_tree(Request $request) {
    // For each board (tree_no 1-5), get the root node (from mlm_plan or from ?root=)
    $all_trees = [];
    for ($tree_no = 1; $tree_no <= 5; $tree_no++) {
        $root = $request->input('root_' . $tree_no);
        if (!$root) {
            // Get first memberid from mlm_plan as root for this board
            $root = DB::table('mlm_plan')->orderBy('id')->value('memberid');
        }
        // Fetch the root node for this board from global_tree
        $root_node = DB::table('global_tree')
            ->where('memberid', $root)
            ->where('tree_no', $tree_no)
            ->first();
        // If not found, skip this board
        if (!$root_node) {
            $all_trees[$tree_no] = null;
            continue;
        }
        // Recursively fetch up to 3 levels (root + 2 child levels)
        $tree = $this->getGlobalTernaryTree($root_node, $tree_no, 2);
        $all_trees[$tree_no] = $tree;
    }
    return view('treeglobal', ['all_trees' => $all_trees]);
}

// Helper to build ternary tree for global_tree up to $levels
private function getGlobalTernaryTree($node, $tree_no, $levels) {
    if ($levels < 0 || !$node) return null;
    $children = [];
    foreach (["p1", "p2", "p3"] as $pos) {
        $child = DB::table('global_tree')
            ->where('placement_id', $node->memberid)
            ->where('pos', $pos)
            ->where('tree_no', $tree_no)
            ->first();
        $children[$pos] = $child ? $this->getGlobalTernaryTree($child, $tree_no, $levels - 1) : null;
    }
    return [
        'node' => $node,
        'children' => $children
    ];
}

public function fast_track_tree(Request $request) {
    // For each board (tree_no 1-2), get the root node (from mlm_plan or from ?root=)
    $all_trees = [];
    for ($tree_no = 1; $tree_no <= 2; $tree_no++) {
        $root = $request->input('root_' . $tree_no);
        if (!$root) {
            // Get first memberid from mlm_plan as root for this board
            $root = DB::table('mlm_plan')->orderBy('id')->value('memberid');
        }
        // Fetch the root node for this board from fast_track_tree
        $root_node = DB::table('fast_track_tree')
            ->where('memberid', $root)
            ->where('tree_no', $tree_no)
            ->first();
        // If not found, skip this board
        if (!$root_node) {
            $all_trees[$tree_no] = null;
            continue;
        }
        // Recursively fetch up to 3 levels (root + 2 child levels)
        $tree = $this->getFastTrackTernaryTree($root_node, $tree_no, 2);
        $all_trees[$tree_no] = $tree;
    }
    return view('treefast', ['all_trees' => $all_trees]);
}

// Helper to build ternary tree for fast_track_tree up to $levels
private function getFastTrackTernaryTree($node, $tree_no, $levels) {
    if ($levels < 0 || !$node) return null;
    $children = [];
    foreach (["p1", "p2", "p3"] as $pos) {
        $child = DB::table('fast_track_tree')
            ->where('placement_id', $node->memberid)
            ->where('pos', $pos)
            ->where('tree_no', $tree_no)
            ->first();
        $children[$pos] = $child ? $this->getFastTrackTernaryTree($child, $tree_no, $levels - 1) : null;
    }
    return [
        'node' => $node,
        'children' => $children
    ];
}

public function achievement_tree(Request $request) {
    // Achievement tree has only 1 tree, uses team filling
    $all_trees = [];
    $tree_no = 1;
    
    $root = $request->input('root_' . $tree_no);
    if (!$root) {
        // Get first memberid from mlm_plan as root for this board
        $root = DB::table('mlm_plan')->orderBy('id')->value('memberid');
    }
    // Fetch the root node for this board from achievement_tree
    $root_node = DB::table('achievement_tree')
        ->where('memberid', $root)
        ->where('tree_no', $tree_no)
        ->first();
    // If not found, set as null
    if (!$root_node) {
        $all_trees[$tree_no] = null;
        $level_counts = array_fill(1, 15, 0); // All zeros for 15 levels
    } else {
        // Recursively fetch up to 3 levels (root + 2 child levels)
        $tree = $this->getAchievementTernaryTree($root_node, $tree_no, 2);
        $all_trees[$tree_no] = $tree;
        
        // Calculate level counts for up to 15 levels
        $level_counts = $this->getAchievementLevelCounts($root, $tree_no);
    }
    
    return view('treeachieve', [
        'all_trees' => $all_trees,
        'level_counts' => $level_counts
    ]);
}

// Helper to build ternary tree for achievement_tree up to $levels
private function getAchievementTernaryTree($node, $tree_no, $levels) {
    if ($levels < 0 || !$node) return null;
    $children = [];
    foreach (["p1", "p2", "p3"] as $pos) {
        $child = DB::table('achievement_tree')
            ->where('placement_id', $node->memberid)
            ->where('pos', $pos)
            ->where('tree_no', $tree_no)
            ->first();
        $children[$pos] = $child ? $this->getAchievementTernaryTree($child, $tree_no, $levels - 1) : null;
    }
    return [
        'node' => $node,
        'children' => $children
    ];
}

// Helper to count nodes at each level in achievement tree
private function getAchievementLevelCounts($root_memberid, $tree_no) {
    $level_counts = array_fill(1, 15, 0);
    
    // Start with root node's children as level 1
    $current_level_nodes = DB::table('achievement_tree')
        ->where('placement_id', $root_memberid)
        ->where('tree_no', $tree_no)
        ->whereIn('pos', ['p1', 'p2', 'p3'])
        ->pluck('memberid')
        ->toArray();
    
    for ($level = 1; $level <= 15; $level++) {
        if (empty($current_level_nodes)) {
            break; // No more nodes to process
        }
        
        $level_counts[$level] = count($current_level_nodes);
        $next_level_nodes = [];
        
        // Get all children of current level nodes
        foreach ($current_level_nodes as $parent_id) {
            $children = DB::table('achievement_tree')
                ->where('placement_id', $parent_id)
                ->where('tree_no', $tree_no)
                ->whereIn('pos', ['p1', 'p2', 'p3'])
                ->pluck('memberid')
                ->toArray();
            
            $next_level_nodes = array_merge($next_level_nodes, $children);
        }
        
        $current_level_nodes = $next_level_nodes;
    }
    
    return $level_counts;
}

public function leader_matrix_tree(Request $request) {
    // Leader Matrix tree has only 1 tree
    $all_trees = [];
    $tree_no = 1;
    
    $root = $request->input('root_' . $tree_no);
    if (!$root) {
        // Get first memberid from mlm_plan as root for this board
        $root = DB::table('mlm_plan')->orderBy('id')->value('memberid');
    }
    // Fetch the root node for this board from leaders_matrix_tree
    $root_node = DB::table('leaders_matrix_tree')
        ->where('memberid', $root)
        ->where('tree_no', $tree_no)
        ->first();
    // If not found, set as null
    if (!$root_node) {
        $all_trees[$tree_no] = null;
    } else {
        // Recursively fetch up to 3 levels (root + 2 child levels)
        $tree = $this->getLeaderMatrixTernaryTree($root_node, $tree_no, 2);
        $all_trees[$tree_no] = $tree;
    }
    
    return view('treeleadermatrix', [
        'all_trees' => $all_trees
    ]);
}

// Helper to build ternary tree for leaders_matrix_tree up to $levels
private function getLeaderMatrixTernaryTree($node, $tree_no, $levels) {
    if ($levels < 0 || !$node) return null;
    $children = [];
    foreach (["p1", "p2", "p3"] as $pos) {
        $child = DB::table('leaders_matrix_tree')
            ->where('placement_id', $node->memberid)
            ->where('pos', $pos)
            ->where('tree_no', $tree_no)
            ->first();
        $children[$pos] = $child ? $this->getLeaderMatrixTernaryTree($child, $tree_no, $levels - 1) : null;
    }
    return [
        'node' => $node,
        'children' => $children
    ];
}

public function repurchase_tree(){ $data = []; return view('treerepur', compact('data')); }

public function members_withdraw_list(){ $data = []; return view('memwithlist', compact('data')); }
public function members_withdraw_report(){ $data = []; return view('memwithreport', compact('data')); } 

public function members_award_list(){ $data = []; return view('awlist', compact('data')); }  

public function cutoff(){ $data = []; return view('cutoff', compact('data')); } 
public function support(){ $data = []; return view('support', compact('data')); } 
public function password(){ $data = []; return view('password', compact('data')); } 

/**
 * Display report of referrals with more than 2 repurchase IDs
 * Analyzes the referral network and counts repurchase IDs per referral
 */
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
        $data = [
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
