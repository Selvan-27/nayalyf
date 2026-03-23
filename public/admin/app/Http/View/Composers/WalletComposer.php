<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Services\WalletService;

class WalletComposer
{
    protected $walletService;

    /**
     * Create a new wallet composer.
     *
     * @param  WalletService  $walletService
     * @return void
     */
    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $walletData = $this->walletService->get_counts_and_numbers();
        
        $view->with([
            'wallet_signups' => $walletData['signups'],
            'wallet_active_members' => $walletData['active_members'],
            'wallet_rebirths' => $walletData['rebirths'],
            'wallet_repurchases' => $walletData['repurchases'],
            'wallet_fast_track_rebirth_ids' => $walletData['fast_track_rebirth_ids'],
            'wallet_data' => $walletData // Also provide the complete array
        ]);
    }
}