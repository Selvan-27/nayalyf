<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user_controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\activation_Controller;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\addressController;
use App\Http\Controllers\challengeController;


use App\Http\Controllers\ContactController;
use App\Http\Controllers\ScheduledCallController;
use App\Http\Controllers\TaskController;

use App\Http\Controllers\Forget_PasswordControllerApi;


use App\Http\Controllers\SupportController;
use App\Jobs\plan_activation_job;



// Route::view('/error', function () {
//   return('ecom.error');
// });

Route::view('/error', 'ecom.error', ['title' => 'Coming Soon', 'content' => 'This is the about page.']);

//Route::view('/', 'coming_soon', ['title' => 'Coming Soon', 'content' => 'This is the about page.']);


Route::controller(HomeController::class)->group(function(){
        
   Route::get('/', 'index')->name('Home');
   
   
});  

Route::controller(user_controller::class)->group(function(){
        
    Route::get('/login', 'login');
    Route::get('/Sign_Up', 'register');
        Route::get('/Forget_Password', 'forgetpassword');
    Route::get('/Terms', 'userterms');
    Route::get('/Contact_Us', 'contact');
});

Route::controller(AuthController::class)->group(function(){

    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
    Route::get('send-OTP', 'send_otp')->name('send-OTP');

});


Route::controller(Forget_PasswordControllerApi::class)->group(function(){
    
    Route::Post('/forgetPassword','forgetPassword');
    Route::get('/reset-password-form', 'reset_password_form');
    Route::post('/updatePassword', 'updatePassword');

});

//------------------------------Auth check-------------------------------------
Route::middleware(['auth'])->group(function () {
    
Route::controller(HomeController::class)->group(function(){
        
   Route::get('/home', 'index')->name('Home');
   Route::get('/product-details', 'product_details')->name('product_details');
   
    
    Route::get('/Home', 'index')->name('Home');
    Route::get('/shop', 'shop2')->name('shop');
        
    Route::get('/Profile', 'profile');
    Route::get('/Profile2', 'profile2');
    Route::get('/Profile_Create', 'Profile_Create');
    
    Route::post('/profile_update', 'profile_update')->name('profile_update');
    
    Route::post('/password/update','updatePassword')->name('password.update');    
    Route::get('/Banking_Edit','Banking_Edit');
    Route::get('/get_member_details', 'get_member_details');
    Route::post('/updateBank','updateBank')->name('bank.update');
    
});  



Route::controller(challengeController::class)->group(function(){
    
    Route::get('/daily', 'index');
    Route::get('/start', 'start');
    Route::post('/challenge/morning', 'morningOpen')->name('challenge.morning');
    Route::post('/challenge/night', 'nightOpen')->name('challenge.night');
    
});

Route::controller(PaymentController::class)->group(function(){
    
    Route::get('/pay', 'index');
  
});

Route::controller(addressController::class)->group(function(){
   
    Route::get('/Address', 'address');
    Route::get('/edit-address/{$id}', 'edit-address/{$id}')->name('edit-address');
    Route::post('/add-address', 'add_address')->name('add-address');
    Route::post('/update-address/{id}', 'update_address')->name('update-address');
    route::get('/delete-address/{id}', 'delete_address')->name('delete-address');
    
});
       
 Route::get('tickets', [SupportController::class, 'index'])->name('tickets.index');
    Route::get('ticket-new', [SupportController::class, 'create'])->name('tickets.create'); // <--- this one
    Route::post('tickets', [SupportController::class, 'store'])->name('tickets.store');
    Route::get('showtickets/', [SupportController::class, 'show'])->name('tickets.show');
    Route::post('tickets/{id}/reply', [SupportController::class, 'reply'])->name('tickets.reply');       
    
    
      Route::controller(ContactController::class)->group(function(){ 
    
    Route::get('/Contact_List', 'index')->name('contacts.index');
    Route::get('/contacts/create',  'create')->name('contacts.create');
    Route::post('/contacts', 'store')->name('contacts.store');
    Route::get('/contacts/{id}/log', 'showLog')->name('contacts.log');
    Route::delete('/contacts/{id}', 'destroy')->name('contacts.destroy');
       
       
       }); 
       
    Route::controller(ScheduledCallController::class)->group(function(){ 
          
    Route::get('/scheduled',  'index')->name('scheduled.index');
    Route::get('/scheduled/create','create')->name('scheduled.create');
    Route::post('/scheduled', 'store')->name('scheduled.store');
    Route::get('/scheduled/{id}/edit', 'edit')->name('scheduled.edit');
    Route::put('/scheduled/{id}', 'update')->name('scheduled.update');

     }); 
  
    Route::get('/ToDo_Tasks1', [TaskController::class, 'index'])->name('tasks.index');


Route::controller(user_controller::class)->group(function(){
        
    Route::get('/Upgrade', 'affiliate');
    Route::get('/Affiliate_Terms', 'affiliateterms');
    
    Route::get('/welcome', 'welcome');
    Route::get('/Activate', 'inactive');
    Route::post('/Activate_user', 'activate_user');
    Route::get('/Notifications', 'notification');
    Route::get('/Payment', 'payment');
  
    Route::get('/UC_Product_Description', 'productdetails');

    Route::get('/Dashboard', 'dashboard');
    Route::get('/UC_Wallet', 'wallet');
    Route::get('/Transactions', 'transaction');
    Route::get('/Sales_Incentive', 'incentive');
    Route::get('/ToDo', 'todo');
    // Route::get('/Contact_List', 'todocontact');
    Route::get('/Contact_Form', 'todoform');
    Route::get('/ToDo_Tracking', 'todoteam');
    Route::get('/ToDo_Tasks', 'todotask');
    Route::get('/ToDo_Tools', 'todotool');
    Route::get('/material', 'material');
    
    Route::get('/Training', 'todotraining');
    Route::get('/ToDoVideos', 'todovideolist');
    

    // Route::get('/Banking_Edit', 'bankedit');
    Route::get('/ID_Card_Form', 'idapply');
    Route::get('/Change_Password', 'changepassword');
    Route::get('/Success_Password', 'successpassword');
    Route::get('/UC_Help', 'help');
    

    Route::get('/get', 'get');
    Route::get('/Awards', 'award');

    
        Route::get('/Invites', 'invite');
    Route::get('/Ignite_Bonus', 'ignite');
    Route::get('/Re-Ignite_Bonus', 'reignite');
    Route::get('/Team_Performance_Bonus', 'teamper');
    Route::get('/Global_Bonus', 'global');
    Route::get('/Fast_Track_Bonus', 'fast');
    Route::get('/Achievement_Bonus', 'achieve');
    Route::get('/Repurchase_Level_Bonus', 'repurlevel');

Route::get('/Leader_Level', 'incomelevel');
Route::get('/Leader_Matrix', 'incomematrix');
Route::get('/Booster_Bonus', 'incomeboost');

Route::get('/referrals_with_repurchases_report', 'referrals_with_repurchases_report');    
    
    
});  


Route::controller(AuthController::class)->group(function(){

//Route::post('register', 'register')->name('register');
//Route::post('login', 'login')->name('login');
Route::get('logout', 'logout');
Route::get('user',  'userProfile');

Route::post('/profile/upload', 'profile_upload')->name('profile.upload');

// Forget Password Routes
Route::post('forget-password', [AuthController::class, 'forgetPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);
Route::post('change-password', [AuthController::class, 'changePassword']);

});  



Route::controller(activation_Controller::class)->group(function(){

Route::post('/withdraw_request', 'withdraw_request')->name('withdraw_request');
Route::post('/deposit_request', 'deposit_request')->name('deposit_request');
Route::get('/activation_request', 'activation_request_page');
Route::post('/activation_wallet_transfer', 'activation_wallet_transfer');
Route::post('/activation_request', 'activation_request')->name('activation_request');
Route::get('/activation_request_2', 'activation_request_page_2');

});
Route::resource('categories', CategoryController::class);


// These routes handle POST from PhonePe
Route::get('/checkPhonePeStatus', [OrderController::class, 'checkPhonePeStatus'])->name('checkPhonePeStatus');
Route::get('/handleStatus', [OrderController::class, 'handleStatus'])->name('handleStatus');

Route::get('/payment-success', [OrderController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment-failure', [OrderController::class, 'paymentFailure'])->name('payment.failure');


Route::controller(OrderController::class)->group(function(){
    
    Route::get('/UC_Shop', 'shop');

    Route::get('/UC_Shop_id_card', 'shop_id_card');
    
    Route::get('/Checkout', 'checkout');
      
    Route::post('/place-order','placeOrder');
    
    Route::post('/Upgrade_account','Upgrade_account');
    Route::get('/checkUpgradeStatus','checkUpgradeStatus');
    Route::get('/checkpayment','checkpayment');
    
    Route::get('/Orders', 'index')->name('orders.index');
    Route::get('/orders/{orderId}/items',  'getOrderItems');
    Route::get('/Cancel-order/{orderId}', 'order_cancel');
    
    Route::get('/Track_Order/{orderId}', 'orderTrack');
    Route::get('/Invoice/{orderId}', 'orderInvoice');
    
}); 
//payment Phoonepe
Route::get('phonepe2',[PaymentController::class,'index']);
Route::get('/phonepe/{id}',[PaymentController::class,'index']);
Route::post('confirmPayment',[PaymentController::class,'confirmPayment'])->name('confirmPayment');

});  
//------------------------------Auth check-------------------------------------

// Route to manually trigger the team_performance_job for testing
Route::get('/run-team-performance-job', function () {
    // You can add dd() here or inside the job for debugging
    dispatch(new team_performance_job());
    dd('team_performance_job dispatched!');
});

// Route to manually trigger the plan_activation_job for testing
Route::get('/run-plan-activation-job', function () {
    dispatch(new plan_activation_job());
    dd('plan_activation_job dispatched!');
});

// Route to test income generation
Route::get('/test-income', function () {
    $incomeController = new App\Http\Controllers\IncomeController();
    
    // Test Reignite Income
    $incomeController->generateReigniteIncome('rebirth123', 'original456');
    
    // Test Team Performance Income
    $incomeController->generateTeamPerformanceIncome('member789', 1);
    
    dd('Income generation tested!');
});
//--------------------------------------------------
