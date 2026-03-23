 $otp = mt_rand(1000, 9999); // Generate a random OTP
            $date = now(); // Get the current date/time
           

            OTP::where('mobile', $mobile)
            ->where('status', 1)
            ->update(['status' => 0]);
    
            $data_otp = [
                'OTP' => $otp,
                'mobile' => $mobile,
                'createdAt' => now(),
                'status' => 1,
             ];
    
                OTP::create($data_otp);

             $message = urlencode('Congrats & Welcome to Grow Score. your OTP Details- '.$otp.' -Grow Score Official');

            
            $url = "http://site.ping4sms.com/api/smsapi?key=e11638c729a9c3ef83541dba73cdaa28&route=2&sender=GRWSCR&templateid=1607100000000313018&number={$mobile}&sms={$message}";

                        $response = Http::get($url);
                        $responseBody = $response->body();

                        if ($response->successful()) {
                            //  if (0==0) {
                            //return 'OTP sent successfully';
                            //return view('user.register2')->with('mobileNo',$mobile);
                            return redirect('/user-verification')->with(['mob' => $mobile, 'success' => 'OTP has been successfully']);

                        } else {
                            //return 'Failed to send OTP';
                            return redirect('/register')->with(['mob' => $mobile, 'error' => 'Invalid Mobile Number..!']);

                        }   