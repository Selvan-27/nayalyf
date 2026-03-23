<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\WalletComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the WalletComposer for all views
        View::composer('*', WalletComposer::class);
        
        // Or if you want to register it for specific views only:
        // View::composer(['home', 'dashboard', 'admin.*'], WalletComposer::class);
    }
}