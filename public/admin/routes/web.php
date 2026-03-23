<?php

use App\Http\Controllers\reports_controller_admin;
use App\Http\Controllers\report_incomesController;
use App\Http\Controllers\BasicOperationsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\members_Controller;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\sliderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\HomeController;


use App\Http\Controllers\StockController;
use App\Http\Controllers\PosController;

use App\Http\Controllers\CutoffController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\AdminAuthController;

use App\Http\Controllers\activation_Controller;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/product-description', function () {
    return view('ecom.summernote');
});



    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    // Route::middleware('auth')->group(function () {
      Route::middleware('auth:admin')->group(function () {
      
        // other admin routes...




Route::controller(members_Controller::class)->group(function(){
    
    Route::get('/members_list', 'members');
    //Route::get('/orders/{orderId}/items',  'getOrderItems');
    //Route::get('/Track_Order/{orderId}', 'orderTrack');

    Route::get('/members_edit', 'edit');
    Route::post('/profile_update', 'profile_update');
  Route::get('/get_member_details', 'get_member_details');
 
}); 

    Route::get('/SupportTicket', [SupportController::class, 'index'])->name('admin.support.index');
    Route::get('/SupportTicket_view', [SupportController::class, 'show'])->name('admin.support.show');
    Route::get('/SupportTicket/reply/{id}', [SupportController::class, 'reply'])->name('admin.support.reply');
    Route::post('/SupportTicket/status', [SupportController::class, 'changeStatus'])->name('admin.support.status');

Route::resource('categories', CategoryController::class);
Route::patch('/categories/{id}/change-status', [CategoryController::class, 'changeStatus'])->name('categories.changeStatus');


Route::resource('products', ProductController::class);
Route::patch('/products/{id}/change-status', [ProductController::class, 'changeStatus'])->name('products.changeStatus');

Route::post('/products-edit/{id}/', [ProductController::class, 'update2']);
Route::get('/products-editable/{id}/', [ProductController::class, 'offer_page_edit2']);


Route::resource('sliders', sliderController::class);
Route::patch('/sliders/{id}/change-status', [sliderController::class, 'changeStatus'])->name('sliders.changeStatus');


Route::controller(OrderController::class)->group(function(){
    Route::post('/place-order','placeOrder');
    Route::get('/orders', 'index');
    Route::get('/orders/{orderId}/items',  'getOrderItems');
    Route::post('/order_update/{orderId}',  'order_update')->name('order.update');
    Route::get('/Track_Order/{orderId}', 'orderTrack');
    // Route::get('/order_invoice/{orderId}', 'orderInvoice')->name('order.invoice');
    
    Route::get('/sales_day', 'sales_report');
}); 

Route::controller(PosController::class)->group(function(){
    Route::get('/pos', 'index')->name('pos.index');
    Route::post('/process-bill', 'processOfflineBill')->name('pos.process');
    Route::get('/order-list', 'orderlist')->name('pos.orderlist');
    Route::get('/order-track/{orderId}', 'orderTrack')->name('pos.orderTrack');
      Route::get('/invoice/{orderId}', 'orderInvoice');
});

Route::controller(StockController::class)->group(function(){
    
      Route::get('/product_stock', 'stock_list');
      Route::post('/update_stock', 'update_stock');
      Route::delete('/delete_stock/{id}', 'delete_stock')->name('delete_stock');
});

Route::controller(PaymentController::class)->group(function(){
    
      Route::get('/pay', 'index');
});


Route::controller(report_incomesController::class)->group(function(){
    
      Route::get('/reports', 'reports');
});


Route::controller(activation_Controller::class)->group(function(){
    
      Route::POST('/Activate', 'activation_request')->name('activation_request');
      Route::POST('/change_memberid', 'change_memberid')->name('change_memberid');
      
      
});




Route::controller(CutoffController::class)->group(function(){
    
         Route::get('/cutoff_dates', 'cutoff_products_dates');
      
         Route::POST('/cutoff_products_dates_insert', 'cutoff_products_dates_insert')->name('cutoff_dates_insert');
         Route::POST('/cutoff_products_dates_delete/{id}', 'cutoff_products_dates_delete')->name('cutoff_products_dates_delete');
      
    
      Route::get('/cutoff', 'cutoff');
      
      Route::POST('/cutoff_insert', 'cutoff_insert')->name('cutoff_insert');
});

Route::controller(WithdrawController::class)->group(function(){
    
      Route::get('/members_withdraw_list', 'members_withdraw_list');   
      Route::get('/withdraw_update', 'withdraw_update');   
      Route::get('/members_withdraw_report', 'Withdraw_report');   
      

});


    Route::get('support', [SupportController::class, 'index'])->name('tickets.index');
    Route::get('tickets', [SupportController::class, 'index'])->name('tickets.index');
    Route::get('ticket-new', [SupportController::class, 'create'])->name('tickets.create'); // <--- this one
    Route::post('tickets', [SupportController::class, 'store'])->name('tickets.store');
    Route::get('showtickets/', [SupportController::class, 'show'])->name('tickets.show');
    Route::post('tickets/{id}/reply', [SupportController::class, 'reply'])->name('tickets.reply');       
    
   Route::controller(HomeController::class)->group(function(){
    
      Route::get('/options/{id}', 'show_options')->name('show_options');
      Route::POST('/option_update_value', 'upoption_update_valuedate')->name('option_update_value');
      
      
}); 

Route::controller(reports_controller_admin::class)->group(function(){
        
    Route::get('/dashboard', 'admin_home')->name('dashboard');
    Route::get('/', 'admin_home');
    // Route::get('/members_list', 'members_list');
    Route::get('/members_deposit_list', 'members_deposit_list');
    Route::get('/members_income_list', 'members_income_list');
    Route::get('/members_create', 'members_create');
    Route::get('/members_activate', 'members_activate');
    // Route::get('/incentive_fix', 'incentive_fix'); // Moved to BasicOperationsController
    Route::get('/members_details', 'members_details');
    Route::post('/members_details', 'members_details');

    Route::get('/members_rebirth_list', 'members_rebirth_list');
    Route::get('/members_repurchase_id_list', 'members_repurchase_id_list');
    Route::get('/members_fasttrack_id_list', 'members_fasttrack_id_list');
    Route::get('/members_orders_list', 'members_orders_list');
    Route::get('/members_kit_list', 'members_kit_list');
    Route::get('/members_card_list', 'members_card_list');
    Route::get('/members_returns_list', 'members_returns_list');
    Route::get('/product_list', 'product_list');
    Route::get('/product_add', 'product_add');
    // Route::get('/product_stock', 'product_stock');
    Route::get('/category_add', 'category_add');

    Route::get('/sales_product', 'sales_product');


    Route::get('/flash_sale', 'flash_sale');
    Route::get('/cutoff_sale', 'cutoff_sale');
    Route::get('/incentive', 'incentive');
    Route::get('/ignite_list', 'ignite_list');
    Route::get('/reignite_list', 'reignite_list');
    Route::get('/team_performance_list', 'team_performance_list');
    Route::get('/global_list', 'global_list');
    Route::get('/fasttrack_list', 'fasttrack_list');
    Route::get('/achievement_list', 'achievement_list');
    Route::get('/repurchase_list', 'repurchase_list');

    Route::get('/team_tree', 'team_tree');
    Route::get('/team_per_tree', 'team_per_tree');
    Route::get('/global_tree', 'global_tree');
    Route::get('/fast_track_tree', 'fast_track_tree');
    Route::get('/achievement_tree', 'achievement_tree');
    Route::get('/leader_matrix_tree', 'leader_matrix_tree');
    Route::get('/repurchase_tree', 'repurchase_tree');


    // Route::get('/members_withdraw_report', 'members_withdraw_report');

    Route::get('/members_award_list', 'members_award_list');
    Route::get('/members_reward_list', 'members_reward_list');
    
    // Route::get('/cutoff', 'cutoff');
    // Route::get('/support', 'support');
    Route::get('/password', 'password');
    
    
});    



    });

// BasicOperations Controller Routes
Route::controller(BasicOperationsController::class)->group(function(){
    Route::get('/incentive_fix', 'incentiveFix')->name('incentive.fix');
    Route::post('/store-incentive-percentage', 'storeIncentivePercentage')->name('store.incentive.percentage');
    Route::get('/delete-incentive-percentage/{id}', 'deleteIncentivePercentage')->name('delete.incentive.percentage');
});