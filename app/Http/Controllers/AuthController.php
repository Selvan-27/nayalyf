<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\OTP;
use App\Models\mlm_plan;
use App\Models\plan_activation_queue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
       // Validate the incoming request
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255',
        //     'mobile_no' => 'required|string|max:15',
        //     'password' => 'required|string|min:4|confirmed',
        // ]);

    $date = Carbon::now();
       
           $referral=$request->sponcer_id; 
           
           $inputOTP=$request->inputOTP;
           
            $get_otp_details = OTP::where(function ($query) use ($request) {
                $query->where('email', $request->email)
              ->orWhere('mobile', $request->mobile_no);
            })
                ->where('is_used', 1)
                ->latest()
                ->first();
            
            if (!$get_otp_details) {
                return redirect()->back()->with('error', 'OTP not found or expired!. Please try again.');
            }
            
            if ($get_otp_details->otp_code != $inputOTP) {
                      return redirect()->back()->with('error', 'Invalid OTP entered!. Please try again.');
                // return response()->json([
                //     'success' => false,
                //     'message' => "Invalid OTP entered!"
                // ]);
            }
        
        if(empty($referral)){
            
            $referral="UC100001"; 
        }
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
           // $memberid = 'UC' . str_pad(User::count() + 1, 7, '0', STR_PAD_LEFT); // Incremental ID with padding, total length 9

            // make memberid random 9 digit character with prefix UC and make a run to check if memberid already exists in database if exists then generate new memberid until unique memberid is generated while (User::where('memberid', $memberid)->exists()) { $memberid = 'UC' . str_pad(User::count() + 1, 7, '0', STR_PAD_LEFT); }
            
            $memberid= 'UC' . str_pad(mt_rand(1111111, 99999999), 7, '0', STR_PAD_LEFT); // Random ID with padding, total length 9 while (User::where('memberid', $memberid)->exists()) { $memberid = 'UC' . str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); }
            
            // check if the memberid already exists in database if exists then generate new memberid until unique memberid is generated 
            
            while (User::where('memberid', $memberid)->exists()) 
            { 
                
            
            $memberid = 'UC' . str_pad(mt_rand(1111111, 99999999), 7, '0', STR_PAD_LEFT); 
            
            }

            

            
       
        // Create a new user record
        $user = User::create([
            'memberid' => $memberid, // Set the generated memberid
            'name' => $request->name,
            'email' => $memberid,
            'real_email' => $request->email,
            'mobile' => $request->mobile_no,
            'pwd' => $request->password,
            'password' => Hash::make($request->password),
        ]);
        
            $legcount = new mlm_plan;
    $legcount->MemberID = $memberid;
    $legcount->placement_id = $referral;
    $legcount->FullName = $request->name;
    $legcount->sponsor_id = $referral;
    $legcount->jdate = $date;
    $legcount->liveStatus = 0;
    $legcount->memberid_type="regular";
    $legcount->save();

        $mobile=$request->mobile_no;

        // Log the user in
        auth()->login($user);
        
        
            //  $message = urlencode('Congrats & Welcome to Grow Score. your OTP Details- '.$otp.' -Grow Score Official');
             $message = urlencode('Dear Customer,Welcome to UNIQCONNECT WC! Your account has been successfully Registered. Your Username: '.$memberid.' Your Password: '.$request->password.' ');

            
                 $url = "http://site.ping4sms.com/api/smsapi?key=d2c26b4873e847d632ca95f21abfafea&route=2&sender=UNIQWC&templateid=1707174558798752882&number={$mobile}&sms={$message}";

                        $response = Http::get($url);
                        $responseBody = $response->body();
                         if ($response->successful()) {
                         
                         }
        
        return redirect('/welcome')->with('success', 'Register Successfully!');
        //return redirect()->route('Home'); // Redirect to home or dashboard
    }

    /**
     * Login a user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
     
     public function login(Request $request)
{
    $credentials = [
        'memberid' => $request->memberid,
        'password' => $request->inputpassword
    ];

    if (Auth::attempt($credentials)) {
        // Authentication passed...
        $request->session()->regenerate();
        $userid =$request->memberid;

    if(plan_activation_queue::where('activation_id', $userid)->where('activation_status','success')->exists())
      {
          $ifuser = User::where('memberid', $userid)->first();
          if(empty($ifuser->account_Number)){
              
              return redirect('/Profile_Create');
          }
      }
        
        return redirect('/Home')->with('success', 'Login Successfully!');
    }

    return back()->withErrors([
        'login' => 'The provided credentials do not match our records.',
    ]);
}


    public function login2(Request $request)
    {
    //     $validator = Validator::make($request->all(), [
    //     'memberid' => 'required|string|max:255',
    //     'inputpassword' => 'required|string|min:4',
    // ]);

    // if ($validator->fails()) {
    //     return redirect()->back()->withErrors($validator)->withInput();
    // }
      
      $userid=$request->memberid;
      $password=$request->inputpassword;
    
        
    if (Auth::attempt(['email' => $userid, 'password' => $password])) {
        $user = Auth::user();
        
        
              
                $request->session()->put('memberid', $request->memberid);
                // $request->session()->put('batch_id', $bid);
                $request->session()->regenerate();
                
          auth()->login($user);
        // return redirect('/home')->with('success', 'Register Successfully!');        
                
        // return redirect()->route('Home')->with('success', 'Login successful!');
        return response()->json(['message' => 'Login successful', 'user' => $user], 200);
    }
        return response()->json(['error' => 'Invalid credentials. Please try again.'], 401);
        // return redirect()->back()->with('error', 'Invalid credentials. Please try again.');
    }

    /**
     * Forget password functionality.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Send a password reset link to the user's email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Password reset link sent to your email']);
        } else {
            return response()->json(['error' => 'Unable to send password reset link.'], 500);
        }
    }

    /**
     * Reset password functionality.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'email' => 'required|string|email|max:255|exists:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Reset the user's password using the token
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password has been reset successfully']);
        } else {
            return response()->json(['error' => 'Failed to reset password'], 500);
        }
    }

    /**
     * Change the authenticated user's password.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided current password is incorrect.'],
            ]);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(Auth::user());
    }

     public function profile_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        // store file in storage/app/public/profile
    $fileName = time().'.'.$request->file->extension();
    $request->file->move(public_path('profile'), $fileName);

    // delete old file if exists
    // if ($user->profile_photo && file_exists(public_path('profile/'.$user->profile_photo))) {
    //     unlink(public_path('profile/'.$user->profile_image));
    // }

        // update user table
        $user->profile_photo = $fileName;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile image updated successfully!',
            'image' => asset('storage/profile/'.$fileName),
        ]);
    }


    /**
     * Logout the user and invalidate the session.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'successfully logged out!');
    }
        public function send_otp(Request $request) {
            

         
        $name = $request->name;
        $email= $request->email;
        $mobile = $request->mobile;
        
        // if(count($mobile)==10){
            
        //      return response()->json([
        //                         'success' => false,
        //                         'message' => "Invalid Mobile Number..!"
        //                     ]);
            
        // }
         
        $otpCode = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(5);

        // Save the OTP to the database
        
       OTP::where('email', $email)
        ->where('is_used', 1)
        ->update(['is_used' => 0]);
            
        $userOtp = new OTP();
        $userOtp->email =$email;
        $userOtp->mobile =$mobile;
        $userOtp->otp_code = $otpCode;
        $userOtp->expires_at = $expiresAt;
        $userOtp->is_used = 1;
        $userOtp->save();
        
        
        //-------------------------send Mail-------------------
        
            $data = [
            'name' =>$name,
            'otpcode' => $otpCode, 
            'email' => $email 
        ];
   
            //--------------------------------------SMS OTP----------------------------------
            
            
            //  $message = urlencode('Congrats & Welcome to Grow Score. your OTP Details- '.$otp.' -Grow Score Official');
             $message = urlencode('Dear Customer,'.$otpCode.' is Your Login OTP for UNIQCONNECTWC. It is valid for 5 minutes. Do not share this code with anyone.');

            
            $url = "http://site.ping4sms.com/api/smsapi?key=d2c26b4873e847d632ca95f21abfafea&route=2&sender=UNIQWC&templateid=1707174558278842044&number={$mobile}&sms={$message}";

                        $response = Http::get($url);
                        $responseBody = $response->body();
                         if ($response->successful()) {
                            //  if (0==0) {
                            //return 'OTP sent successfully';
                            //return view('user.register2')->with('mobileNo',$mobile);
                             return response()->json([
                                'success' => true,
                                'message' => "OTP has been successfully"
                            ]);

                        } else {
                              return response()->json([
                                'success' => false,
                                'message' => "Failed to send OTP"
                            ]);

                        }
                        
            //----------------------------------------MAIL OTP --------------------------------------------            
            // Mail::send('mail.OTP', $data, function($message) use ($email,$name) {
            //     $message->to($email, $name)
            //             ->subject(' Welcome to RYTE Crypto! ')
            //             ->from('rytecrypto@gmail.com', 'RYTE Crypto');
            //             // ->attach('https://t4.ftcdn.net/jpg/02/52/93/81/360_F_252938192_JQQL8VoqyQVwVB98oRnZl83epseTVaHe.jpg');
            // });
      
         //-------------------------send Mail-------------------
         
           return response()->json([
            'success' => true,
            'message' => 'OTP Send successfully.',
            'otp' => $otpCode // Note: For production, do not return the OTP in the response.
        ]);
    //   echo "Basic Email Sent. Check your inbox.";
   }
   
    public function check_exists_mail(Request $request){
        
         $email= $request->email;
        
         $detailsofuser = User::where('email', $email)->first();
        
        
        if(empty($detailsofuser)){
          
          return response()->json([
            'success' => true,
            'message' => "200"
        ]);
        
        }else{
          return response()->json([
            'success' => true,
            'message' => 'This Email is already registered'
        ]);
        
        }
        
    }
}
