<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\coin;
use App\Models\UserOtp;
use App\Models\admin;
use App\Models\mlm_plan;
use App\Models\board_1;
use App\Models\board_2;
use App\Models\board_3;
use App\Models\board_4;
use App\Models\board_user_income;
use App\Models\BoardUserIncome2;
use App\Models\detailsofuser;
use App\Models\legcount;
use App\Models\levelincome;
use App\Models\plan_wallet;
use App\Models\withdraw_history;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Http;

use App\Services\WalletService;


class WithdrawController extends Controller
{
   
        
public function members_withdraw_list(){ 
     $data = withdraw_history::where('status','pending')->get();
    
    return view('withdraw.withlist', compact('data')); }


public function Withdraw_report(){ 
     $data = withdraw_history::where('status','!=','pending')->get();
    
    return view('withdraw.Withdraw_report', compact('data')); }




public function get_member_details(Request $request){
    $id=$request->memberid;
    $user = User::where('memberid', $id)->first();
    if (!$user) {
        return response()->json(['error' => 'User not found!']);
    }

    $user->refer_count = mlm_plan::where('sponsor_id', $user->memberid)->count('memberid');
    $user->activation_status = $user->board_memberid ? 'Active' : 'Inactive';
    
    return response()->json($user);
}

    public function withdraw_update(Request $request){
         $id=$request->id;
         $remake=$request->remake;
        $order = withdraw_history::findOrFail($id);
        $order->status = $request->input('wstatus');
        $order->remarks = $remake;
        $order->save();

         return redirect()->back()->with('success', 'Withdraw updated successfully!');
    }

}
