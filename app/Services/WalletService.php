<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use App\Models\TBLpinwallet;
use App\Models\plan_wallet;
use App\Models\income_all;

use App\Models\mlm_plan;
use App\Models\board_user_income;
use App\Models\booster_income;
use App\Models\BoardUserIncome2;
use App\Models\withdraw_history;

// include  nessary models 

use App\Models\plan_activation_queue;
use App\Models\referral_income;
use App\Models\re_ignite_income;
use App\Models\team_performance_income;
use App\Models\global_bonus_income;
use App\Models\fast_track_income;
use App\Models\repurchase_level_income;
use App\Models\achievement_level_income;
use App\Models\Orders;
use App\Models\topupdetails;
use App\Models\unique_incentive_income;


use Illuminate\Support\Facades\DB;



use Illuminate\Support\Facades\Auth;



class WalletService
{
    /**
     * Calculate all MLM income types for a given member
     *
     * @param string $memberid
     * @return array
     */
    public function calculateAllIncomes($memberid)
    {

        $date = Carbon::now();
        $date= $date->format('Y-m-d');
        // dd($memberid);
        // Check if member is active
        $is_member_active = $this->checkMemberActiveStatus($memberid);

        // dd($is_member_active);

        // IGNITE Bonus (Referral Income)
        $ignite_payout = round(referral_income::where('memberid', $memberid)->sum('payout'), 2);
        $ignite_netpay = round(referral_income::where('memberid', $memberid)->sum('netpay'), 2);

        // RE-IGNITE Bonus (from rebirths)
        $reignite_payout = round(re_ignite_income::where('memberid', $memberid)->sum('payout'), 2);
        $reignite_netpay = round(re_ignite_income::where('memberid', $memberid)->sum('netpay'), 2);

        // Team Performance Bonus
        $team_performance_payout = round(team_performance_income::where('memberid', $memberid)->where('ignored', '<', 1)->sum('payout'), 2);
        $team_performance_netpay = round(team_performance_income::where('memberid', $memberid)->where('ignored', '<', 1)->sum('netpay'), 2);

        // Global Bonus
        $global_bonus_payout = round(global_bonus_income::where('memberid', $memberid)->where('ignored', '<', 1)->sum('payout'), 2);
        $global_bonus_netpay = round(global_bonus_income::where('memberid', $memberid)->where('ignored', '<', 1)->sum('netpay'), 2);

//         // Fast Track Bonus
// // 1) find related member IDs from mlm_plan (fastrack / fastrack_rebirth)
// $relatedIds = mlm_plan::whereIn('memberid_type', ['fastrack', 'fast_track_rebirth'])
//     ->where("all_father_id", $memberid)
//     ->pluck('memberid')
//     ->toArray();
    
//  //dd($relatedIds);

// // optional: debug/log to see what we found
// \Log::info('Related fast-track IDs for ' . $memberid . ': ' . json_encode($relatedIds));

// // 2) include the input member id itself
// $ids = array_merge([$memberid], $relatedIds);

// // 3) fetch aggregated sums in a single query (safe and efficient)
// $totals = fast_track_income::whereIn('memberid', $ids)
//     ->selectRaw('COALESCE(ROUND(SUM(payout), 2), 0) AS fast_track_payout, COALESCE(ROUND(SUM(netpay), 2), 0) AS fast_track_netpay')
//     ->first();

// $fast_track_payout = (float) ($totals->fast_track_payout ?? 0);
// $fast_track_netpay = (float) ($totals->fast_track_netpay ?? 0);


// Fast Track Bonus
$totals = fast_track_income::where('memberid', $memberid)
    ->orWhereRaw('FIND_IN_SET(?, all_father_id)', [$memberid])
    ->selectRaw('ROUND(COALESCE(SUM(payout),0),2) as fast_track_payout,
                 ROUND(COALESCE(SUM(netpay),0),2) as fast_track_netpay')
    ->first();

$fast_track_payout = (float) ($totals->fast_track_payout ?? 0);
$fast_track_netpay = (float) ($totals->fast_track_netpay ?? 0);



        // Repurchase Level Bonus
        $repurchase_level_payout = round(repurchase_level_income::where('memberid', $memberid)->sum('payout'), 2);
        $repurchase_level_netpay = round(repurchase_level_income::where('memberid', $memberid)->sum('netpay'), 2);

        // Achievement Bonus (multiple levels possible)
        $achievement_payout = round(
            achievement_level_income::where('memberid', $memberid)
            ->whereDate('eldate', '<=', Carbon::today())
            ->sum('payout'), 
            2
        );
        $achievement_netpay = round(
            achievement_level_income::where('memberid', $memberid)
            ->whereDate('eldate', '<=', Carbon::today())
            ->sum('netpay'), 
            2
        );


     $booster_income = booster_income::where('booster_income.memberid', Auth::user()->memberid)->where('status',1)
->sum('payout');    
        
// Sales Incentive 

$unique_incentive_totals = unique_incentive_income::where('unique_incentive_income.memberid', $memberid)
    ->join('ecom_orders', 'unique_incentive_income.order_id', '=', 'ecom_orders.order_id')
    ->where('ecom_orders.status', '=', 'delivered')
    // ->where('unique_incentive_income.created_at', '<=', now()->subHours(5))
    ->selectRaw('ROUND(COALESCE(SUM(unique_incentive_income.payout),0),2) as unique_incentive_payout,
                 ROUND(COALESCE(SUM(unique_incentive_income.netpay),0),2) as unique_incentive_netpay')
    ->first();

$unique_incentive_payout = (float) ($unique_incentive_totals->unique_incentive_payout ?? 0);
$unique_incentive_netpay = (float) ($unique_incentive_totals->unique_incentive_netpay ?? 0);

        
        // Calculate total earnings
        $total_payout = $ignite_payout + $reignite_payout + $team_performance_payout + 
                       $global_bonus_payout + $fast_track_payout + $repurchase_level_payout + $achievement_payout + $unique_incentive_payout+$booster_income;

        $total_netpay = $ignite_netpay + $reignite_netpay + $team_performance_netpay + 
                       $global_bonus_netpay + $fast_track_netpay + $repurchase_level_netpay + $achievement_netpay + $unique_incentive_netpay+$booster_income;


  //pv Calculations
    
       $totalPv = Orders::where('user_id', $memberid)
        ->where('status', '=', 'delivered')
        // ->where('created_at', '<=', Carbon::now()->subHours(5))
        ->sum('PV');
                    
       $existingRepurchaseCount = mlm_plan::where('all_father_id', $memberid)
                    ->where('memberid_type', 'repurchase')
                    ->count();

                // Calculate available PV after deducting already used PV
                $usedPv = $existingRepurchaseCount * 1600;
                $availablePv = $totalPv - $usedPv;
    //----------------------------- 

          
$total_withdraw = round(withdraw_history::where('memberid', $memberid)
    ->where(function($query) {
        $query->where('status', 'success')
              ->orWhere('status', 'pending')
              ->orWhere('status', 'processing');
    })
    ->sum('payout'), 2);


  $successfull_withdraw = round(withdraw_history::where('memberid', $memberid)
    ->where('status', 'success')
    ->sum('payout'), 2);  


    // get sum of from_income_wallet from Orders model 

    $from_income_wallet = round(
        Orders::where('user_id', $memberid)
            ->where('status', '=', 'delivered')
            ->sum('from_income_wallet'),
        2
    );


    // get sum of topupdetails 

    $topup_amount = round(topupdetails::where('loginid', $memberid)->sum('amount'), 2);

    $withdrawable_amount = $total_netpay - $from_income_wallet - $total_withdraw - $topup_amount;



        return [
            // Member status
            'is_active' => $is_member_active,
            
            // Individual income payouts
            'ignite_payout' => $ignite_payout,
            'reignite_payout' => $reignite_payout,
            'team_performance_payout' => $team_performance_payout,
            'global_bonus_payout' => $global_bonus_payout,
            'fast_track_payout' => $fast_track_payout,
            'repurchase_level_payout' => $repurchase_level_payout,
            'achievement_payout' => $achievement_payout,
            'unique_incentive_payout' => $unique_incentive_payout,
            
            // Individual income netpays
            'ignite_netpay' => $ignite_netpay,
            'reignite_netpay' => $reignite_netpay,
            'team_performance_netpay' => $team_performance_netpay,
            'global_bonus_netpay' => $global_bonus_netpay,
            'fast_track_netpay' => $fast_track_netpay,
            'repurchase_level_netpay' => $repurchase_level_netpay,
            'achievement_netpay' => $achievement_netpay,
            'unique_incentive_netpay' => $unique_incentive_netpay,
            'booster_income'=>$booster_income,
            'availablePV' => $availablePv,
            
            // Total earnings
            'total_payout' => $total_payout,
            'total_netpay' => $total_netpay,
            'withdrawable_amount' => $withdrawable_amount,
            'total_withdraw' => $total_withdraw,
            'successfull_withdraw' => $successfull_withdraw,
        ];
    }

    /**
     * Check if a member is active based on activation queue status
     *
     * @param string $memberid
     * @return bool
     */
    public function checkMemberActiveStatus($memberid)
    {
        // Join mlm_plan and plan_activation_queue tables
        // Member is active only if activation_status is 'success'
        $memberStatus = DB::table('mlm_plan')
            ->leftJoin('plan_activation_queue', 'mlm_plan.memberid', '=', 'plan_activation_queue.activation_id')
            ->where('mlm_plan.memberid', $memberid)
            ->where('plan_activation_queue.activation_status', 'success')
            ->first();

        return $memberStatus !== null;
    }

    /**
     * Get user profile information
     *
     * @param object $user
     * @return array
     */
    public function getUserInfo($user)
    {
          $mlm_plan = mlm_plan::where('memberid', $user->memberid)->first();

        return [
            'member_name' => $user->name ?? 'User',
            'member_id' => $user->memberid ?? $user->id,
            'member_rank' => $mlm_plan->rank ?? 'Bronze',
            'active_date' => $user->created_at ? $user->created_at->format('d M Y') : 'N/A',
        ];
    }
   
    
    public function income_cal()
    {  

        $date = Carbon::now();
        $date= $date->format('Y-m-d');

        
        $login_id = Auth::user()->memberid;  

        $mlm_plan = mlm_plan::where('memberid', $login_id)->first();

  //plan wallet calculation
    $plan_wallet = round(plan_wallet::where('memberid', $login_id)->sum('amount'), 2);

  // spending from plan wallet
  
$spending_from_plan_wallet = plan_activation_queue::where('login_id', $login_id)
        ->whereIn('activation_status', ['success', 'pending', 'processing'])
        ->sum('amount');
        
  $spending_from_plan_wallet = round($spending_from_plan_wallet,2);

  // sent from plan wallet
  

  $sent_plan_wallet = plan_wallet::where('recieved_from', $login_id)->sum('amount');   
  $sent_plan_wallet = round($sent_plan_wallet,2);


  $plan_wallet_total = $plan_wallet - $spending_from_plan_wallet;

// MLM Plan Activation Income Calculations

// IGNITE Bonus (Referral Income)
$ignite_payout = round(referral_income::where('memberid', $login_id)->sum('payout'), 2);
$ignite_netpay = round(referral_income::where('memberid', $login_id)->sum('netpay'), 2);

// RE-IGNITE Bonus (from rebirths)
$reignite_payout = round(re_ignite_income::where('memberid', $login_id)->sum('payout'), 2);
$reignite_netpay = round(re_ignite_income::where('memberid', $login_id)->sum('netpay'), 2);

// Team Performance Bonus
$team_performance_payout = round(team_performance_income::where('memberid', $login_id)->sum('payout'), 2);
$team_performance_netpay = round(team_performance_income::where('memberid', $login_id)->sum('netpay'), 2);

// Global Bonus
$global_bonus_payout = round(global_bonus_income::where('memberid', $login_id)->sum('payout'), 2);
$global_bonus_netpay = round(global_bonus_income::where('memberid', $login_id)->sum('netpay'), 2);

// Fast Track Bonus
$fast_track_payout = round(fast_track_income::where('memberid', $login_id)->sum('payout'), 2);
$fast_track_netpay = round(fast_track_income::where('memberid', $login_id)->sum('netpay'), 2);

// Repurchase Level Bonus
$repurchase_level_payout = round(repurchase_level_income::where('memberid', $login_id)->sum('payout'), 2);
$repurchase_level_netpay = round(repurchase_level_income::where('memberid', $login_id)->sum('netpay'), 2);

// Achievement Bonus (placeholder for future implementation)
$achievement_payout = round(achievement_level_income::where('memberid', $login_id)->sum('payout'), 2);
$achievement_netpay = round(achievement_level_income::where('memberid', $login_id)->sum('netpay'), 2);


// Sales Incentive 

$unique_incentive_payout = round(unique_incentive_income::where('memberid', $login_id)->sum('payout'), 2);
$unique_incentive_netpay = round(unique_incentive_income::where('memberid', $login_id)->sum('netpay'), 2);


// Calculate total MLM income
$total_mlm_payout = $ignite_payout + $reignite_payout + $team_performance_payout + $unique_incentive_payout +
                   $global_bonus_payout + $fast_track_payout + $repurchase_level_payout + $achievement_payout;

$total_mlm_netpay = $ignite_netpay + $reignite_netpay + $team_performance_netpay + $unique_incentive_netpay +
                   $global_bonus_netpay + $fast_track_netpay + $repurchase_level_netpay + $achievement_netpay; 


// total withdraw is status success or pending or processing


$total_withdraw = round(withdraw_history::where('memberid', $login_id)
    ->where(function($query) {
        $query->where('status', 'success')
              ->orWhere('status', 'pending')
              ->orWhere('status', 'processing');
    })
    ->sum('payout'), 2);


$deposit= plan_wallet::whereNotNull('transaction_id')
    ->join('users', 'users.memberid', '=', 'plan_wallet.memberid')
    ->select('users.*', 'plan_wallet.*')
    ->sum('amount');
    
    
             

return [
'plan_wallet' => $plan_wallet,
'plan_wallet_total' => $plan_wallet_total,
'ignite_payout' => $ignite_payout,
'ignite_netpay' => $ignite_netpay,
'reignite_payout' => $reignite_payout,
'reignite_netpay' => $reignite_netpay,
'team_performance_payout' => $team_performance_payout,
'team_performance_netpay' => $team_performance_netpay,
'global_bonus_payout' => $global_bonus_payout,
'global_bonus_netpay' => $global_bonus_netpay,
'fast_track_payout' => $fast_track_payout,
'fast_track_netpay' => $fast_track_netpay,
'repurchase_level_payout' => $repurchase_level_payout,
'repurchase_level_netpay' => $repurchase_level_netpay,
'achievement_payout' => $achievement_payout,
'achievement_netpay' => $achievement_netpay,
'unique_incentive_payout' => $unique_incentive_payout,
'unique_incentive_netpay' => $unique_incentive_netpay,
'total_mlm_payout' => $total_mlm_payout,
'total_mlm_netpay' => $total_mlm_netpay,
'total_withdraw' => $total_withdraw,
'deposit' => $deposit
];

    }


    public function user_count()
    {  

        $date = Carbon::now();
        $date= $date->format('Y-m-d');

        
        $login_id = Auth::user()->memberid;  

        $mlm_plan = mlm_plan::where('memberid', $login_id)->first();

        // total member count from mlm_plan . sponsorid is login_id

        $number_of_referrals = mlm_plan::where('sponsor_id', $login_id)
        ->where('memberid_type', 'regular')  
        ->count();

        // number of active referrals

        $active_referrals = mlm_plan::where('mlm_plan.sponsor_id', $login_id)
        ->where('memberid_type', 'regular')  
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
            ->from('plan_activation_queue')
            ->whereRaw('plan_activation_queue.activation_id = mlm_plan.memberid')
            ->where('plan_activation_queue.activation_status', 'success');
        })
        ->count();


    return [
'number_of_referrals'=>$number_of_referrals,
'active_referrals'=> $active_referrals
];






    }

    public function getRebirth_data()
    {
        $login_id = Auth::user()->memberid;
        $rebirth_ids = mlm_plan::where('original_id', $login_id)
            ->where('memberid_type', 'rebirth')
            ->orderBy('created_at')
            ->get();
        $rebirth_count = $rebirth_ids->count();
        
        return [
            'rebirth_ids' => $rebirth_ids,
            'rebirth_count' => $rebirth_count
        ];
    }

    public function getFastTrackRebirth_data()
    {
        $login_id = Auth::user()->memberid;
        $fast_track_rebirth_ids = mlm_plan::where('original_id', $login_id)
            ->where('memberid_type', 'fast_track_rebirth')
            ->orderBy('created_at')
            ->get();
        $fast_track_rebirth_count = $fast_track_rebirth_ids->count();
        
        return [
            'fast_track_rebirth_ids' => $fast_track_rebirth_ids,
            'fast_track_rebirth_count' => $fast_track_rebirth_count
        ];
    }

    public function getRepurchase_data()
    {
        $login_id = Auth::user()->memberid;
        $repurchase_ids = mlm_plan::where('all_father_id', $login_id)
            ->where('memberid_type', 'repurchase')
            ->orderBy('created_at')
            ->get();
        $repurchase_count = $repurchase_ids->count();
        
        return [
            'repurchase_ids' => $repurchase_ids,
            'repurchase_count' => $repurchase_count
        ];
    }


}


?>
