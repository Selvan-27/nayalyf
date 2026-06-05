<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\address;
use App\Models\Orders;
use App\Models\withdraw_history;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Http;

use App\Services\WalletService;


class addressController extends Controller
{

    public function address_update_page(){
        return view('ecom.address-update-page');
    }

    public function update_address_kit(Request $request){
        
          $address = new address();
            $address->user_id = Auth::user()->memberid; // Assuming you want to link to the logged-in user
            $address->full_name = $request->full_name;
            $address->mobile_no = $request->mobile_no;
            $address->pincode = $request->inputcode;
            $address->street_address = $request->inputaddress;
            $address->city = $request->inputcity;
            $address->state = $request->memberState;
            $address->district = $request->memberdistrict;
            $address->save();
        
             $welcome_kit=Orders::where('user_id',Auth::user()->memberid)->first();

        if($welcome_kit->address_id==0){
          
            $update=Orders::where('user_id',Auth::user()->memberid)->update([
                 'address_id' => $address->id,
            ]);
           return redirect('home')->with('success', 'Address added successfully!');

        }
    }

        public function address(){
             $user_id = Auth::user()->memberid;
              $data = address::where('user_id',$user_id)->get();
         // return  $data = address::join('users', 'users.memberid', '=', 'address.user_id')
           // ->select('users.name', 'users.memberid', 'address.*')
            //->get();
            
            return view('ecom.addres', compact('data'));
        }
        public function add_address(Request $request){
            
            // $request->validate([
            //     'full_name' => 'required|string|max:255',
            //     'mobile' => 'required|string|max:20',
            //     'pincode' => 'required|string|max:10',
            //     'address_line1' => 'required|string|max:255',
            //     'city' => 'required|string|max:100',
            //     'state' => 'required|string|max:100',
            //     'country' => 'required|string|max:100',
            // ]);
        
            $address = new address();
            $address->user_id = Auth::user()->memberid; // Assuming you want to link to the logged-in user
            $address->full_name = $request->full_name;
            $address->mobile_no = $request->mobile_no;
            $address->pincode = $request->inputcode;
            $address->street_address = $request->inputaddress;
            $address->city = $request->inputcity;
            $address->state = $request->memberState;
            $address->district = $request->memberdistrict;
            $address->save();
        
            // return back()->with('success', 'Address added successfully!');
           return redirect('/Checkout')->with('success', 'Address added successfully!');
        
        
        }
        public function edit_address($id){
            
            $address = address::find($id);
            if (!$address) {
                return back()->with('error', 'Address not found!');
            }
            return view('edit_address', compact('address'));
        }
        public function update_address(Request $request, $id){
            
            // $request->validate([
            //     'full_name' => 'required|string|max:255',
            //     'mobile' => 'required|string|max:20',
            //     'pincode' => 'required|string|max:10',
            //     'address_line1' => 'required|string|max:255',
            //     'city' => 'required|string|max:100',
            //     'state' => 'required|string|max:100',
            //     'country' => 'required|string|max:100',
            // ]);
        

            $address = address::find($id);
            if (!$address) {
                return back()->with('error', 'Address not found!');
            }
        
            $address->full_name = $request->full_name;
            $address->mobile_no = $request->mobile_no;
            $address->pincode = $request->pincode;
            $address->street_address = $request->street_address;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->district = $request->district;
            $address->save();
        
            return back()->with('success', 'Address updated successfully!');
        }
        
        public function delete_address($id){
            
            $address = address::find($id);
            if (!$address) {
                return back()->with('error', 'Address not found!');
            }
            $address->delete();
            return back()->with('success', 'Address deleted successfully!');
        }
}
   