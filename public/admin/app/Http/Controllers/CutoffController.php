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
use App\Models\team_performance_queue;
use App\Models\re_ignite_queue;
use App\Models\mlm_plan;

use App\Models\repurchase_cutoff_slots;
use App\Models\awards_and_rewards_cutoff_slots;

use App\Models\cutoff_dates;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOTP;

class CutoffController extends Controller
{
   
    
 
    public function cutoff(){
        
     $data =repurchase_cutoff_slots::get();
         
       return view('cutoff', compact('data'));
    }
    
    
    public function cutoff_insert(Request $request){
    
    //   $login_id= session()->get('memberid');
      $date = Carbon::now();
     $date= $date->format('Y-m-d');
        
        $cutoffstart=$request->cutoffstart;
        $cutoffend=$request->cutoffend;
        $cutoffname=$request->cutoffname;
        // check if the input memberid already exists in the mlm_plan model

  
      if(repurchase_cutoff_slots::where('name', $request->cutoffname)->exists())
      {
        return back()->with('error', 'Already Activated.');
      }

        $transaction = new repurchase_cutoff_slots();
        $transaction->name = $cutoffname;
        $transaction->from_date = $cutoffstart;
        $transaction->to_date = $cutoffend;
           
    if($transaction->save()){
        
        
        
        $transaction2 = new awards_and_rewards_cutoff_slots();
        $transaction2->name = $cutoffname;
        $transaction2->from_date = $cutoffstart;
        $transaction2->to_date = $cutoffend;
        
                if($transaction2->save()){
             return back()->with('success', 'CutOff created successful.');
            } else {
                // Redirect back with an error message
                return back()->with('error', 'Invalid Error.');
            }
        
         //return back()->with('success', 'Activated  Queue created successful.');
    } else {
        // Redirect back with an error message
        return back()->with('error', 'Invalid Error.');
    }
    

        
    }  
        
         
 public function cutoff_products_dates(Request $request){
        
      $mode=$request->mode;
        
        $data =cutoff_dates::where('type',$mode)->get();
         
       return view('ecom.cutoff_products_dates', compact('data'));
    }


  public function cutoff_products_dates_insert(Request $request){

         $cutoffstart=$request->cutoffstart;
        $cutoffend=$request->cutoffend ?? null;
        $mode=$request->mode;
        
        $transaction = new cutoff_dates();
        $transaction->from_date = $cutoffstart;
        
        $transaction->to_date = $mode=="flashsale" ? $cutoffstart : $cutoffend;
        $transaction->type=$mode;
    if($transaction->save()){
             return back()->with('success', 'CutOff created successful.');
    } else {
        // Redirect back with an error message
        return back()->with('error', 'Invalid Error.'); 

}
    }
    
    public function cutoff_products_dates_delete($id){
        
        $transaction = cutoff_dates::find($id);
    if($transaction->delete()){ 
             return back()->with('success', 'CutOff deleted successful.');
    } else {
        // Redirect back with an error message
        return back()->with('error', 'Invalid Error.');
         
}
    }
} 
