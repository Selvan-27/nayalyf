<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Services\WalletService;

class WalletComposer
{
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $login_id = $user->memberid;
            
            // Get income data from WalletService
            $incomeData = $this->walletService->calculateAllIncomes($login_id);
            
            // Get user information from WalletService
            $userData = $this->walletService->getUserInfo($user);
            
            // Get user count data (referrals, active members)
            $userCountData = $this->walletService->user_count();
            
            // Get rebirth data
            $rebirthData = $this->walletService->getRebirth_data();
            $fastTrackRebirthData = $this->walletService->getFastTrackRebirth_data();
            $repurchaseData = $this->walletService->getRepurchase_data();
            
            $view->with(array_merge($incomeData, $userData, $userCountData, $rebirthData, $fastTrackRebirthData, $repurchaseData));
        } else {
            // Default values for guests
            $view->with([
                'ignite_payout' => 0,
                'reignite_payout' => 0,
                'team_performance_payout' => 0,
                'global_bonus_payout' => 0,
                'fast_track_payout' => 0,
                'repurchase_level_payout' => 0,
                'achievement_payout' => 0,
                'ignite_netpay' => 0,
                'reignite_netpay' => 0,
                'team_performance_netpay' => 0,
                'global_bonus_netpay' => 0,
                'fast_track_netpay' => 0,
                'repurchase_level_netpay' => 0,
                'achievement_netpay' => 0,
                'total_payout' => 0,
                'total_netpay' => 0,
                'member_name' => 'Guest',
                'member_id' => 'N/A',
                'member_rank' => 'N/A',
                'active_date' => 'N/A',
                'number_of_referrals' => 0,
                'active_referrals' => 0,
                'rebirth_count' => 0,
                'rebirth_ids' => collect(),
            ]);
        }
    }
}
