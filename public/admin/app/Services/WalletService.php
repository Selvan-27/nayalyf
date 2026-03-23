<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use App\Models\TBLpinwallet;
use App\Models\plan_wallet;
use App\Models\income_all;

use App\Models\mlm_plan;
use App\Models\board_user_income;
// use App\Models\board_referral_income;
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


use Illuminate\Support\Facades\DB;



use Illuminate\Support\Facades\Auth;



class WalletService
{

    public function get_counts_and_numbers()
    {
        // admin side to track all counts 

        $signups= mlm_plan::where('memberid_type','regular')->count();

        $active_members= mlm_plan::where('memberid_type', 'regular')  
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
            ->from('plan_activation_queue')
            ->whereRaw('plan_activation_queue.activation_id = mlm_plan.memberid')
            ->where('plan_activation_queue.activation_status', 'success');
        })
        ->count();


          $rebirths= mlm_plan::where('memberid_type','rebirth')->count();

          $repurchases= mlm_plan::where('memberid_type','repurchase')->count();

          $fast_track_rebirth_ids= mlm_plan::where('memberid_type','fast_track_rebirth')->count();


        
          return [

              'signups' => $signups,
              'active_members' => $active_members,
              'rebirths' => $rebirths,
              'repurchases' => $repurchases,
              'fast_track_rebirth_ids' => $fast_track_rebirth_ids,
          ];

    }

    public function get_member_details($member_id = null)
    {
        if (!$member_id) {
            return [
                'member' => null,
                'sponsor' => null,
                'activation_date' => null,
                'rank' => 'Not Found',
                'total_earnings' => 0,
                'total_withdrawn' => 0,
                'wallet_balance' => 0,
                'direct_referrals' => [],
                'rebirth_ids' => [],
                'repurchase_ids' => [],
                'fast_track_ids' => []
            ];
        }

        // Get member details
        $member = mlm_plan::where('memberid', $member_id)->first();
        
        if (!$member) {
            return [
                'member' => null,
                'sponsor' => null,
                'activation_date' => null,
                'rank' => 'Not Found',
                'total_earnings' => 0,
                'total_withdrawn' => 0,
                'wallet_balance' => 0,
                'direct_referrals' => [],
                'rebirth_ids' => [],
                'repurchase_ids' => [],
                'fast_track_ids' => []
            ];
        }

        // Get sponsor details
        $sponsor = null;
        if ($member->sponser_id) {
            $sponsor = mlm_plan::where('memberid', $member->sponser_id)->first();
        }

        // Get activation date
        $activation = plan_activation_queue::where('activation_id', $member_id)
            ->where('activation_status', 'success')
            ->first();

        // Calculate total earnings from all income sources
        $total_earnings = income_all::where('memberid', $member_id)->sum('amount');

        // Calculate total withdrawn
        $total_withdrawn = withdraw_history::where('memberid', $member_id)
            ->where('status', 'success')
            ->sum('amount');

        // Calculate wallet balance
        $wallet_balance = $total_earnings - $total_withdrawn;

        // Get direct referrals
        $direct_referrals = mlm_plan::where('sponser_id', $member_id)
            ->where('memberid_type', 'regular')
            ->with(['activationQueue' => function($query) {
                $query->where('activation_status', 'success');
            }])
            ->get();

        // Get rebirth IDs for this member
        $rebirth_ids = mlm_plan::where('sponser_id', $member_id)
            ->where('memberid_type', 'rebirth')
            ->get();

        // Get repurchase IDs for this member
        $repurchase_ids = mlm_plan::where('sponser_id', $member_id)
            ->where('memberid_type', 'repurchase')
            ->get();

        // Get fast track IDs for this member
        $fast_track_ids = mlm_plan::where('sponser_id', $member_id)
            ->where('memberid_type', 'fast_track_rebirth')
            ->get();

        return [
            'member' => $member,
            'sponsor' => $sponsor,
            'activation_date' => $activation ? $activation->created_at : null,
            'rank' => $this->calculateMemberRank($member_id),
            'total_earnings' => $total_earnings,
            'total_withdrawn' => $total_withdrawn,
            'wallet_balance' => $wallet_balance,
            'direct_referrals' => $direct_referrals,
            'rebirth_ids' => $rebirth_ids,
            'repurchase_ids' => $repurchase_ids,
            'fast_track_ids' => $fast_track_ids
        ];
    }

    private function calculateMemberRank($member_id)
    {
        // This is a placeholder for rank calculation logic
        // You can implement your specific rank calculation based on your MLM plan
        $member = mlm_plan::where('memberid', $member_id)->first();
        
        if (!$member) return 'Not Found';
        
        // Basic rank calculation - you can enhance this based on your requirements
        $direct_count = mlm_plan::where('sponser_id', $member_id)
            ->where('memberid_type', 'regular')
            ->count();
            
        if ($direct_count >= 50) return 'Diamond';
        if ($direct_count >= 25) return 'Gold';
        if ($direct_count >= 10) return 'Silver';
        if ($direct_count >= 5) return 'Bronze';
        if ($direct_count >= 1) return 'Distributor';
        
        return 'Member';
    }


}


?>
