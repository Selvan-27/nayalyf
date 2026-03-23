<?php

namespace App\Http\Controllers;
use App\Models\Product_galleries;
use App\Models\Product_stocks;
use App\Models\Product;
use App\Models\Slider;
use App\Models\plan_activation_queue;
use App\Models\User;
use App\Models\mlm_plan;
use App\Models\Category;
use App\Models\address;
use App\Models\Orders;
use App\Models\Orders_items;
use App\Models\cutoff_dates;
use App\Models\options;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    // List all categories
    public function index()
    {
        $slider = Slider::where('is_active','1')->get();
        
        $products=Product::where('type','products')->where('is_active',1)->where('id','>',5)->get();
        
         $discount=options::where('id',5)->value('value');
            
             
       // return $cutoff_dates= cutoff_dates::all();
  
      
        $products_3 = Product::join('cutoff_dates', function($join) {
               $join->whereDate('cutoff_dates.from_date', '=', now())
         ->where('cutoff_dates.type', '=', 'flashsale');
        })
 
        ->where('ecom_products.id', 3)
        ->select('ecom_products.*', 'cutoff_dates.from_date', 'cutoff_dates.to_date')
        ->first();

        $products_4 = Product::join('cutoff_dates', function($join) {
            $join->whereDate('cutoff_dates.from_date', '<=', now())
                 ->whereDate('cutoff_dates.to_date', '>=', now())
         ->where('cutoff_dates.type', '=', 'cutoff');
        })
        ->where('ecom_products.id', 4)
        ->select('ecom_products.*', 'cutoff_dates.from_date', 'cutoff_dates.to_date')
        ->first();
        
        $business_list = Product::where('type','business')->get();
        
        $categories = Category::all();
      
        
         //if(plan_activation_queue::where('activation_id', $user_id)->where('activation_status','success')->exists()){
             
            return view('home', compact('discount','products','business_list','categories','slider','products_3','products_4'));
      //}else{
          
        //    return back()->with('error', 'Inactive ID.');
               
        //}
        
    }
    

    
    public function profile(){
        
         $user_id = Auth::user()->memberid;
          $user=User::where('memberid', $user_id)->first();
          $mlm_plan=mlm_plan::where('memberid', $user_id)->first();
          // $user->promo;
          $sponsor=User::where('memberid',$mlm_plan->sponsor_id)->first();
         return view('account', compact('user','sponsor'));
             
    }
    
      public function profile2(){
        
         $user_id = Auth::user()->memberid;
          $user=User::where('memberid', $user_id)->first();
          $mlm_plan=mlm_plan::where('memberid', $user_id)->first();
          // $user->promo;
          $sponsor=User::where('memberid',$mlm_plan->sponsor_id)->first();
         return view('accountinactive', compact('user','sponsor'));
             
    }
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password'      => ['required'],
        'new_password'          => ['required', 'string', 'min:4', 'confirmed'],
    ]);

    $user = Auth::user();

    // Check current password
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    // Update password
    $user->password = Hash::make($request->new_password);
    $user->pwd = $request->new_password;
    $user->save();

    return back()->with('success', 'Password updated successfully!');
}

   public function Banking_Edit(){
        
         $user_id = Auth::user()->memberid;
          $user=User::where('memberid', $user_id)->first();
         
         return view('editbank', compact('user'));
             
    }
    
    
       public function Profile_Create(){
        
         $user_id = Auth::user()->memberid;
          $user=User::where('memberid', $user_id)->first();
         
         return view('profilefirst', compact('user'));
             
    }
    
    
        public function profile_update(Request $request){
            
              $user_id = Auth::user()->memberid;
    
            $user = User::where('memberid', $user_id)->first();
            if (!$user) {
                return response()->json(['error' => 'User not found!']);
            }
            
             $user->gender = $request->gender;
             $user->dob = $request->memberdob;
             $user->bank_Name = $request->acnumber;
             $user->holder_name = $request->acname;
             $user->account_Number =$request->acname;
             $user->branch_Name =$request->branchname;
             $user->ifsc_Code=$request->ifsc;
             $user->save();
            
    
            $address = new address();
            $address->user_id = Auth::user()->memberid; // Assuming you want to link to the logged-in user
            $address->full_name =$request->acnumber;
            $address->mobile_no = $request->mobile_no;
            $address->pincode = $request->inputcode;
            $address->street_address = $request->inputaddress;
            $address->city = $request->inputcity;
            $address->state = $request->memberState;
            $address->district = $request->memberdistrict;
            $address->save();
            
            
            //place order 
            
        $total = 1600;
        $grand_total = 1600;
        $userId =  $user_id = Auth::user()->memberid;
        // $addressId = $request->input('address_id');
        $totalPV = 0;
        $delivery_charge = 50;
        $totalWallet = 0;
        $orderId=  'ORD-' . time() . rand(100, 999);
        // Step 1: Create the order
      $order = Orders::create([
            // 'order_id'   => strtoupper(Str::random(10)),
            'order_id' => $orderId,
            'user_id'    => $userId,
            'total'      => $total,
            'from_income_wallet'=> $totalWallet,
            'delivery_charges'=> $delivery_charge,
            'payable'=> $grand_total,
            'PV'      => $totalPV,
            'status'     => 'pending',
            'mode'     => 'Online',
            'order_date'     => now(),
            'address_id' => $address->id,
        ]);

        // Step 2: Insert cart items

             
            Orders_items::create([
                'order_id'   => $order->id,
                'product_id' => 2,
                'quantity'   => 1,
                'price'      => 1600,
            ]);
        
        //return back()->with('success', 'Password updated successfully!');
            
        //return response()->json(['message' => 'Order placed successfully!', 'order_id' => $order->order_id]);
        
        return redirect()->route('Home')->with('success', 'Profile updated successfully!');
    
        }
    public function get_member_details(Request $request){
    $id=$request->memberid;
    $user = User::where('memberid', $id)->first();
    if (!$user) {
        return response()->json(['error' => 'User not found!']);
    }

    $user->refer_count = mlm_plan::where('sponsor_id', $user->memberid)->count('memberid');
    
    $st = plan_activation_queue::where('activation_id', $user->memberid)->value('activation_status');
    
    $user->activation_status = ($st == "success") ? 'Active' : 'Inactive';
    
    return response()->json($user);
}

}