<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\deposit_using_transaction_id_queue; 
use App\Models\plan_activation_queue;
use App\Models\withdraw_history;
use App\Models\plan_wallet;
use App\Models\User;
use App\Models\OTP;
use App\Models\mlm_plan;
use App\Models\team_performance_queue;
use App\Services\WalletService;


use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOTP;

class activation_Controller extends Controller
{
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }
    
    
    public function activation_request_page(){
        
            return view('user.activation_request');
    }
    
    
        
    public function activation_request_page_2(){
        
            return view('user.activation_request_2');
    }
    
    
    public function activation_request(Request $request){
    
       $login_id = Auth::user()->memberid;  
       $date = Carbon::now();
        $date= $date->format('Y-m-d');
        
        
      $plan = mlm_plan::where('memberid', $request->Memberid)->first();

    if (!$plan) {
    return back()->with('error', 'Member ID does not exist.');
    }

    if ($plan->memberid_type !== 'regular') {
    return back()->with('error', 'Only regular member IDs can be activated.');
    }


      if(plan_activation_queue::where('activation_id', $request->activation_id)->exists())
      {
        return back()->with('error', 'Already Activated.');
      }

        $transaction = new plan_activation_queue();

        $transaction->login_id = $login_id;
        $transaction->activation_id =  $request->activation_id;
        $transaction->status = "success";
        $transaction->activation_status = "pending";
        $transaction->board=1;
        $transaction->date=$date;
           
    if($transaction->save()){
        
        //     //-------------------------send Mail-------------------
        //           $email = 'rytecn1@gmail.com';
                   
        //                         $name =$login_id;
        //     $data = [
        //      'name' =>$login_id,
        //     'otpcode' => $login_id, 
        //     'email' => 'rytecn1@gmail.com' 
        // ];
   
        //     Mail::send('mail.OTP', $data, function($message) use ($email,$name) {
        //         $message->to($email, $name)
        //                 ->subject('withdraw Request for RYTE Crypto')
        //                 ->from('rytecrypto@gmail.com', 'RYTE Crypto');
        //                 // ->attach('https://t4.ftcdn.net/jpg/02/52/93/81/360_F_252938192_JQQL8VoqyQVwVB98oRnZl83epseTVaHe.jpg');
        //     });
      
         //-------------------------send Mail-------------------
             return back()->with('success', 'Activation Request created successful.');
    } else {
        // Redirect back with an error message
        return back()->with('error', 'Invalid Error.');
    }
    

            // return back()->with([
            //     'message' => 'Transaction created successfully.',
            // ], 201);
            
        }
        
        
        
            public function withdraw_request(Request $request){
                
    
       $login_id= Auth::user()->memberid;  
       $date = Carbon::now();
        $date= $date->format('Y-m-d');

        $item = User::where('memberid',$login_id)->first();
        
        
        
        //   if(empty($item->wallet)){
                    
        //             $check_wallet=$item->wallet;
                    
        //  return back()->with('error', 'Please add your wallet address.');

        //  }

        //  $email=$item->real_email;
        //  $name=$item->name;

        $withdraw_history = withdraw_history::where('memberid', $login_id)->whereIn('status', ['pending', 'processing'])->exists();

        if($withdraw_history){
            return back()->with('error', 'You have already made the withdraw request.');
        }


        // check if there is enough balance in the wallet

        // $values_all=$this->walletService->income_cal();

        // $withdrawable_income_total = $values_all['withdrawable_income_total'];
         $withdrawable_income_total = 10000;
        if($withdrawable_income_total < $request->wallet_ID){
            return back()->with('error', 'Insufficient balance.');
        }

        // minimum withdraw amount is 5

        // if($request->wallet_ID < 1){
        //     return back()->with('error', 'Minimum withdraw amount is 5.');
        // }



               // generate unique transaction id and use a loop to verify if it is unique and save it to the withdraw_history table

               $transaction_id = uniqid();

               $transaction_id_exists = withdraw_history::where('transactionId', $transaction_id)->exists();
       
               while($transaction_id_exists){
                   $transaction_id = uniqid();
                   $transaction_id_exists = withdraw_history::where('transactionId', $transaction_id)->exists();
               }
  

 $transaction = new withdraw_history();
      $transaction->memberid = $login_id;
$transaction->service_charge = $request->wallet_ID * 0.10;   // 10% service charge
$transaction->payout = $request->wallet_ID; // 90% payout
$transaction->netpay = $request->wallet_ID * 0.90;  // same as payout (if no other deductions)
$transaction->transactionId = $transaction_id;
$transaction->status = "pending";
$transaction->date = $date;

           
    if($transaction->save()){
        
         //-------------------------send Mail-------------------
        
        //     $data = [
        //     'name' =>$name,
        //     'otpcode' => $login_id, 
        //     'email' => $email 
        // ];
   
            // Mail::send('mail.OTP', $data, function($message) use ($email,$name,$login_id) {
            //     $message->to($email, $name)
            //             ->subject('Withdraw Request to '.$login_id)
            //             ->from('rytecrypto@gmail.com', 'RYTE Crypto');
            //             // ->attach('https://t4.ftcdn.net/jpg/02/52/93/81/360_F_252938192_JQQL8VoqyQVwVB98oRnZl83epseTVaHe.jpg');
            // });
      
         //-------------------------send Mail-------------------
         
            return back()->with('success', 'Withdraw Request created successful.');
    } else {
        // Redirect back with an error message
        return back()->with('error', 'Invalid Error.');
    }
    

            // return back()->with([
            //     'message' => 'Transaction created successfully.',
            // ], 201);
            
        }
        
            public function deposit_request(Request $request){
    
       $login_id= session()->get('memberid');
       
        $item = User::where('memberid',$login_id)->first();
        
         $email=$item->real_email;
         $name=$item->name;

       
        $date = Carbon::now();
        $date= $date->format('Y-m-d');

    //   if(plan_activation_queue::where('activation_id', $request->wallet_ID)->exists())
    //   {
    //     return back()->with('error', 'Already Activated.');
    //   }

        $transaction = new deposit_using_transaction_id_queue();

        $transaction->login_id = $login_id;
        $transaction->transaction_id = $request->wallet_ID;
        $transaction->status = "pending";
        $transaction->activation_status = "pending";
       
        $transaction->date=$date;
           
    if($transaction->save()){
        
          //-------------------------send Mail-------------------
        
        // $data = [
        //     'name' =>$name,
        //     'otpcode' => $login_id, 
        //     'email' => $email 
        // ];
   
        //     Mail::send('mail.OTP', $data, function($message) use ($email,$name,$login_id) {
        //         $message->to($email, $name)
        //                 ->subject('Deposit Request to '.$login_id)
        //                 ->from('rytecrypto@gmail.com', 'RYTE Crypto');
        //                 // ->attach('https://t4.ftcdn.net/jpg/02/52/93/81/360_F_252938192_JQQL8VoqyQVwVB98oRnZl83epseTVaHe.jpg');
        //     });
      
         //-------------------------send Mail-------------------
         
            return back()->with('success', 'Deposit Request created successful.');
    } else {
        // Redirect back with an error message
        return back()->with('error', 'Invalid Error.');
    }
    

            // return back()->with([
            //     'message' => 'Transaction created successfully.',
            // ], 201);
            
 }


 public function activation_request_manual(){


    $login_id= session()->get('memberid');
    $date = Carbon::now();
    $date= $date->format('Y-m-d');

    
    $transaction = new plan_activation_queue();

    $transaction->login_id = $login_id;
    $transaction->activation_id = $login_id;
    $transaction->status = "success";
    $transaction->activation_status = "pending";
    $transaction->amount=50;
    $transaction->board=1;
    $transaction->date=$date;
    $transaction->save();

 }


    public function activation(Request $request){
       

        /// check if the user exists in db

        $user = User::where('memberid', $request->activation_id)->first();

        if(!$user){
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        // check if the user is already activated 


        return 0;
    }


    public function activation_wallet_transfer(Request $request){
        
        $login_id= session()->get('memberid');

        $date = Carbon::now();
        $date= $date->format('Y-m-d');

        // check if the user exists in db
        
        
           $email= Auth::user()->real_email;
            $otp= $request->input_otp;
           
            $check_otp = OTP::where('email', $email)->where('otp_code',$otp)->first();
        if(!$check_otp){
            
              return back()->with('error', 'Incorrect OTP');
           
        }
        $user = User::where('memberid', $request->reciever_id)->first();

        if(!$user){
            
              return back()->with('error', 'User not found');
           
        }

        // check if the user is already activated 


        $already_active = plan_activation_queue::where('activation_id', $request->reciever_id)
        ->where('board', 1)
        ->whereIn('activation_status', ['success', 'pending', 'processing'])
        ->exists();

        if($already_active){


         return back()->with('error', 'User already activated.');
              }

        // check if the user has enough balance

        $values_all=$this->walletService->income_cal();

        $withdrawable_income_total = $values_all['withdrawable_income_total'];

        if($withdrawable_income_total < 50){
            
              return back()->with('error', 'Insufficient balance');
              
        }


        // insert to plan_wallet 

        $transaction = new plan_wallet();
        $transaction->recieved_from = $login_id;
        $transaction->memberid = $request->reciever_id;
        $transaction->date = $date;
        $transaction->amount = 50;
        $transaction->save();


        // show success message

        return back()->with('success', 'Transaction created successfully');
        


    }






}
