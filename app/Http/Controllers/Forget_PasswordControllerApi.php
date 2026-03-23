<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;


use App\Models\otp;
use Carbon\carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\attendance;
use App\Models\leave;

class Forget_PasswordControllerApi extends Controller
{
   public function forgetPassword(Request $request)
    {
        
       $user = User::where('real_email', $request->input('email'))
            ->orWhere('memberid', $request->input('email'))
            ->first();


        if (!$user) {
            // return response()->json([
            //     'status' => 'error',
            //     'message' => 'Email not found.'
            // ], 404);
            return redirect()->back()->with('error','Invalid User');
        }
        $encryptedId = Crypt::encryptString($user->memberid);
        $link = url('/reset-password-form?token=' . urlencode($encryptedId));

        // $link = 'https://selsons.com/reset-password-form?user_id=' . $user->user_id;

        Mail::send('reset_link', ['user' => $user, 'link' => $link], function ($message) use ($user) {
            $message->to($user->real_email)->subject('Reset Your Password');
        });

            $email=$user->real_email;
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Reset link sent to your email.',
        //     'reset_link' => $link
        // ]);
         return redirect()->back()->with('success','Check Your Email '.$email. ' to Resent Your Password');
    }
    
 
    public function reset_password_form(Request $request ){
         $user_id_token=$request->token;
        $user_id = Crypt::decryptString($user_id_token);
         return view('reset_password',compact('user_id'));
    }
    

public function updatePassword(Request $request)
{
   
    
     $user_id=$request->user_id;
     $user_id=$request->new_password;

     $user = User::where('memberid', $request->user_id)->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Invalid user.');
    }

    $user->pwd = $request->new_password;
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect('/login')->with('success', 'Password updated successfully.');
}   
    
    
    
    
    
    
    
    
   


}