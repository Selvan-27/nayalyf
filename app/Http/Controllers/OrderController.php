<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Models\mlm_plan;
use App\Models\unique_incentive_income_configurations;

use App\Models\plan_activation_queue;
use App\Models\unique_incentive_income;
use App\Models\booster_income;
use App\Models\Category;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Orders_items;
use App\Models\address;
use App\Models\payments;

class OrderController extends Controller
{
    
    

    public function shop_id_card(){
         $data=Product::where('id',1)->get();
        
    return view('ecom.cart_id_card', compact('data'));
        
    }
    
    public function shop(){
         
         $data=Product::all();
         
    return view('ecom.cart', compact('data'));
        
    }

    public function checkout(){
            
                 $user_id = Auth::user()->memberid;
              $data = address::where('user_id',$user_id)->get();
            
        return view('ecom.checkout', compact('data'));}

    //public function index(){
        //$user_id = Auth::user()->memberid;
        
        // $pending = Orders::where('user_id',$user_id)->whereNotIn('status', ['delivered', 'cancelled','temp']) ->latest()->get();
        // $delivered = Orders::where('user_id',$user_id)->where('status','delivered') ->latest()->get();
        // $cancelled = Orders::where('user_id',$user_id)->where('status','cancelled') ->latest()->get();
        
      //   return view('ecom.orders', compact('pending','delivered','cancelled'));
    //}
    
    public function index(Request $request){
    $user_id = Auth::user()->memberid;

    // Get search and date filter inputs from the request
    $search = $request->input('search');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Build the base query for pending orders
    $pendingQuery = Orders::where('user_id', $user_id)
                          ->whereNotIn('status', ['delivered', 'cancelled']);

    // Apply search filter if provided
    if ($search) {
        $pendingQuery->where(function($query) use ($search) {
            $query->where('order_id', 'like', '%' . $search . '%')
                //   ->orWhere('product_name', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%');
        });
    }

    // Apply date range filter if provided
    if ($startDate && $endDate) {
        $pendingQuery->whereBetween('created_at', [$startDate, $endDate]);
    }

    // Retrieve the filtered pending orders
    $pending = $pendingQuery->latest()->get();

    // Repeat the same logic for delivered and cancelled orders
    $deliveredQuery = Orders::where('user_id', $user_id)->where('status', 'delivered');
    if ($search) {
        $deliveredQuery->where(function($query) use ($search) {
            $query->where('order_id', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%');
        });
    }
    if ($startDate && $endDate) {
        $deliveredQuery->whereBetween('created_at', [$startDate, $endDate]);
    }
    $delivered = $deliveredQuery->latest()->get();

    $cancelledQuery = Orders::where('user_id', $user_id)->where('status', 'cancelled');
    if ($search) {
        $cancelledQuery->where(function($query) use ($search) {
            $query->where('order_id', 'like', '%' . $search . '%')
                  ->orWhere('status', 'like', '%' . $search . '%');
        });
    }
    if ($startDate && $endDate) {
        $cancelledQuery->whereBetween('created_at', [$startDate, $endDate]);
    }
    $cancelled = $cancelledQuery->latest()->get();

    // Pass the filtered results to the view
    return view('ecom.orders', compact('pending', 'delivered', 'cancelled'));
}

    
    public function getOrderItems($orderId) {

   return $items = DB::table('ecom_order_items as oi')
        ->leftJoin('ecom_products as p', 'oi.product_id', '=', 'p.id')
        ->leftJoin('ecom_products as sp', 'oi.product_sub_id', '=', 'sp.id') // join sub product
        ->select(
            'oi.id',
            'oi.order_id',
            'oi.product_id',
            'p.name as product_name',

            'oi.product_sub_id',
            'sp.name as sub_product_name', // NEW

            'oi.quantity',
            'oi.price as item_price',
            DB::raw('oi.price * oi.quantity as total_price'),
            'oi.created_at'
        )
        ->where('oi.order_id', $orderId)
        ->get();

    return response()->json($items);
}


    // public function getOrderItems($orderId){
    // //$items = Orders_items::where('order_id', $orderId)->get();
    //   $items = DB::table('ecom_order_items as oi')
    // ->join('ecom_products as p', 'oi.product_id', '=', 'p.id')
    // ->select(
    //     'oi.id',
    //     'oi.order_id',
    //     'oi.product_id',
    //     'p.name as product_name',
    //     'oi.quantity',
    //     'oi.price as item_price',
    //     DB::raw('oi.price * oi.quantity as total_price'),
    //     'oi.created_at'
    // )
    // ->where('oi.order_id', $orderId) // pass $orderId from route/controller
    // ->get();
    
    // return response()->json($items);
    // }
    
    public function orderInvoice($orderId){

          $orders = Orders::findOrFail($orderId);
        if (!$orders) {
            return redirect()->back()->with('error', 'Order not found.');
        }

         $customer = User::where('memberid', $orders->user_id)->first();
       //items
        $orderitems = Orders_items::from('ecom_order_items as oi')
    ->leftJoin('ecom_products as p', 'oi.product_id', '=', 'p.id')       // main product
    ->leftJoin('ecom_products as sp', 'oi.product_sub_id', '=', 'sp.id') // sub product
    ->where('oi.order_id', $orderId)
    ->select(
        'oi.*',

        // main product info
        'p.name as product_name',
        'p.HSN as product_HSN',
        'p.Tax as product_Tax',
        'p.CGST as product_CGST',
        'p.SGST as product_SGST',

        // sub product info
        'sp.name as sub_product_name',
        'sp.HSN as sub_product_HSN',
        'sp.Tax as sub_product_Tax',
        'sp.CGST as sub_product_CGST',
        'sp.SGST as sub_product_SGST'
    )
    ->get();

         
    $address=[];
    if($orders['address_id']){
                 $address = address::findOrFail($orders['address_id']);

}
        return view('ecom.order_invoice', compact('orderitems', 'customer','orders','address'));

    }
    
    public function orderTrack($orderId)
    {
        
    $orders = Orders::where('order_id', $orderId)->first();
    $orders_items = Orders_items::where('order_id', $orders->order_id)->get();
    $orderId =$orders->order_id;
     $orderItems = DB::table('ecom_order_items as oi')
    ->join('ecom_products as p', 'oi.product_id', '=', 'p.id')
    ->select(
        'oi.id',
        'oi.order_id',
        'oi.product_id',
        'p.name as product_name',
        'oi.quantity',
        'oi.price as item_price',
        DB::raw('oi.price * oi.quantity as total_price'),
        'oi.created_at'
    )
    ->where('oi.order_id', $orderId) // pass $orderId from route/controller
    ->get();

 
    $orders_from = $orders->created_at; // timestamp from DB
 $orders_from_seconds = Carbon::now()->diffInSeconds(Carbon::parse($orders_from));
    
    if($orders_from_seconds>18000){
        $orders_from_seconds=0;
    }
    
      return view('ecom.ordertrack', compact('orders','orders_items','orders_from_seconds'));
    }
    
        public function placeOrder(Request $request){
    //          $request->validate([
    //     'cart' => 'required|array',
    //     'total' => 'required|numeric',
    //     'grand_total' => 'required|numeric',
    //     'totalPV' => 'required|numeric',
    //     'delivery_charge' => 'required|numeric',
    //     'totalWallet' => 'required|numeric',
    //     'address_id' => 'required|integer',
    // ]);

    $cart = $request->input('cart');
    $total = $request->input('total');
    $grand_total = $request->input('grand_total');
    $userId = Auth::user()->memberid;
    $addressId = $request->input('address_id');
    $totalPV = $request->input('totalPV');
    $delivery_charge = $request->input('delivery_charge');
    $totalWallet = $request->input('totalWallet');

    $orderId = 'ORD-' . time() . rand(100, 999);
    
//      return response()->json([
//     'success' => false,
//     'redirect_url' => $orderId
// ]);


    $redirectUrl = 'https://uniqconnectwc.com/checkPhonePeStatus?transactionId='.$orderId; // Define this route
     $redirectUrl_Err = 'https://uniqconnectwc.com/checkpayment?id='.$orderId; 

    $amount = $grand_total;

    $data = [
        'merchantId' => 'M22GQ40FO5WRR',
        'merchantTransactionId' => $orderId,
        'merchantUserId' => $userId,
        'amount' => $amount * 100,
        'redirectUrl' => $redirectUrl,
        'redirectMode' => 'GET',
        'callbackUrl' => $redirectUrl_Err,
        'mobileNumber' => Auth::user()->mobile ?? '0000000000',
        'paymentInstrument' => [
            'type' => 'PAY_PAGE',
        ],
    ];

    $encode = base64_encode(json_encode($data));
    $saltKey = 'db1c9b6e-62e7-41e3-a066-830b52ce2fd9';
    $saltIndex = 1;
    $string = $encode . '/pg/v1/pay' . $saltKey;
    $sha256 = hash('sha256', $string);
    $finalXHeader = $sha256 . '###' . $saltIndex;

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.phonepe.com/apis/hermes/pg/v1/pay',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'X-VERIFY: ' . $finalXHeader
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        return response()->view('error', ['message' => 'Payment initiation failed: ' . $err], 500);
    }

    $rData = json_decode($response);
 $loginToken = Str::random(40);
    if (isset($rData->success) && $rData->success && isset($rData->data->instrumentResponse->redirectInfo->url)) {
        // ✅ Insert order in DB (status: temp)
        $order = Orders::create([
            'order_id' => $orderId,
            'user_id' => $userId,
            'total' => $total,
            'from_income_wallet' => $totalWallet,
            'delivery_charges' => $delivery_charge,
            'payable' => $grand_total,
            'PV' => $totalPV,
            'order_status' => 'Waiting',
            'status' => 'temp',
            'mode' => 'Online',
            'order_date' => now(),
            'login_token' => $loginToken, 
            'address_id' => $addressId,
        ]);

        foreach ($cart as $item) {
            // if ($item['qty'] > 0) {
            //     Orders_items::create([
            //         'order_id' => $order->id,
            //         'product_id' => $item['id'],
            //         'quantity' => $item['qty'],
            //         'price' => $item['price'],
            //     ]);
            // }
            if ($item['qty'] > 0) {

    // check product id only 4 or 3
    if (in_array($item['id'], [3, 4])) {

        // fetch product
        $main_product = Product::where('id', $item['id'])->first();

        if ($main_product) {

            // 1st insert → use m_qty & price
            Orders_items::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'product_sub_id' => $main_product->main_product,
                'quantity'   => $main_product->m_qty,
                'price'      => $main_product->price,
            ]);

            // 2nd insert → use o_qty & price = 0
            Orders_items::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'product_sub_id' => $main_product->offer_product,
                'quantity'   => $main_product->o_qty,
                'price'      => 0,
            ]);
        }

    } else {

        $main_product = Product::where('id', $item['id'])->first();

            if ($main_product) {
                
            //     if($main_product->spl==1){
            //       booster_income::create([
            //     'memberid'   => $userId,
            //     'payout' => 1000,
            //     'netpay'   => 1000,
            //     'eldate'  => now(),
            //     'fromId'   => $userId,
            // ]);  
                    
            //     }
            // normal insert for all other products
            Orders_items::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'quantity'   => $item['qty'],
                'price'      => $item['price'],
                'spl'      => $main_product->spl,
            ]);
        }   
        
           $this->processBoosterIncome($order, $userId);
    }
}

        }
    
        // ✅ Redirect to PhonePe payment page
        // return redirect()->away($rData->data->instrumentResponse->redirectInfo->url);
        return response()->json([
    'success' => true,
    'redirect_url' => $rData->data->instrumentResponse->redirectInfo->url
]);


    } else {
        $errorMessage = $rData->message ?? 'An error occurred! Please try again.';
        return response()->view('error', ['message' => $errorMessage], 500);
    }
        }
     
public function handleStatus($transactionId)
{
    try {
        // ✅ Choose correct URL
        $baseUrl = "https://api.phonepe.com/apis/hermes/pg/v1/status"; 
        // Sandbox: "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status"

        $merchantId = env('PHONEPE_MERCHANT_ID'); 
        $saltKey    = env('PHONEPE_SALT_KEY'); 
        $saltIndex  = env('PHONEPE_SALT_INDEX', 1);

        // API endpoint
        $url = $baseUrl . "/" . $merchantId . "/" . $transactionId;

        // ✅ Generate X-VERIFY
        $stringToHash = "/pg/v1/status/" . $merchantId . "/" . $transactionId . $saltKey;
        $sha256 = hash("sha256", $stringToHash);
        $xVerify = $sha256 . "###" . $saltIndex;

        // ✅ Make API request
        $response = Http::withHeaders([
            "Content-Type"  => "application/json",
            "X-VERIFY"      => $xVerify,
            "X-MERCHANT-ID" => $merchantId,
        ])->get($url);

        return $response->json();

    } catch (\Exception $e) {
        return [
            'success' => false,
            'status'  => 'ERROR',
            'message' => "Exception: " . $e->getMessage()
        ];
    }
}


public function checkPhonePeStatus(Request $request)
{
    $transactionId = $request->transactionId;

    // ✅ Step 1: Call PhonePe status API (or receive status directly)
    $statusResponse = $this->handleStatus($transactionId); // or get from request

    // Example $statusResponse:
    // {"success":true,"status":"COMPLETED","message":"Your payment is successful."}

    if ($statusResponse['success'] && $statusResponse['data']['state'] === 'COMPLETED') {

        // ✅ Step 2: Find the order
        $order = Orders::where('order_id', $transactionId)->first();

        if ($order) {
            // ✅ Step 3: Update order status
            $order->status = 'pending';
            $order->order_status = 'paid';
            $order->save();
            
        $existing = plan_activation_queue::where('activation_id', $order->user_id)
    ->where('activation_status', 'success')
    ->get();


            // ✅ Step 4: Auto-login user (optional)
            if ($order->login_token && $order->user_id) {
                $user = User::where('memberid', $order->user_id)->first();

                if ($user) {
                    Auth::login($user);
                    
                     $oo = $order->order_id;  
                    $tt = $order->total;  
                    $mobile=$user->mobile;
                   
                    
                    //-------------------Start
                       
               $orderItems = Orders_items::where('order_id', $order->order_id)
    ->where('spl', 1)
    ->get();

$userId = $order->user_id;

foreach ($orderItems as $orderItem) {
    $this->checkEligibleBoostersIncome($orderItem, $userId);
}

                     //-------------------Start sms
             $message = urlencode('Thank you for your purchase from UNIQCONNECT WC! Order ID: '.$oo.' Product: {#var#} Amount: ₹'.$tt.' Need help? Contact us at 000 ');

            
                 $url = "http://site.ping4sms.com/api/smsapi?key=d2c26b4873e847d632ca95f21abfafea&route=2&sender=UNIQWC&templateid=1707174558071253063&number={$mobile}&sms={$message}";

                        $response = Http::get($url);
                        $responseBody = $response->body();
                         if ($response->successful()) {
            
                         }
            //------------------End sms

                }
            }

            // ✅ Step 5: Redirect to success page
 return redirect('/Orders?backto=Home')->with('success', 'Order placed successfully..!');
            // return view('payment.success', ['order' => $order]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Order not found.'
        ], 404);
    }

    // ❌ If payment failed or pending
     return redirect('/Orders?backto=Home')->with('error', 'Payment not completed..!');
     
    // return view('payment.failed', [
    //     'message' => $statusResponse['message'] ?? 'Payment not completed.',
    //     'transactionId' => $transactionId
    // ]);
}


public function checkUpgradeStatus(Request $request)
{
    $transactionId = $request->transactionId;

    // ✅ Step 1: Call PhonePe status API (or receive status directly)
    $statusResponse = $this->handleStatus($transactionId); // or get from request

    // Example $statusResponse:
    // {"success":true,"status":"COMPLETED","message":"Your payment is successful."}

    if ($statusResponse['success'] && $statusResponse['data']['state'] === 'COMPLETED') {

        // ✅ Step 2: Find the order
        $order = payments::where('order_id', $transactionId)->first();

        if ($order) {
            // ✅ Step 3: Update order status
            $order->status = 'success';
            // $order->amount = $statusResponse['message'] ?? 'Payment successful';
            $order->save();


            // ✅ Step 4: Auto-login user (optional)
            if ($order->login_token && $order->user_id) {
                $user = User::where('memberid', $order->user_id)->first();

                if ($user) {
                    Auth::login($user);
                    
                    //-----------

                    $login_id = $order->user_id;  
                    
                    $oo = $order->order_id;  
                    $tt = $order->total;  
                    $mobile=$user->mobile;
                    
                    $date = Carbon::now();
                    $date= $date->format('Y-m-d');
                   
                   
                    $transaction = new plan_activation_queue();
                    $transaction->login_id = "online_payment";
                    $transaction->activation_id = $login_id;
                    $transaction->status = "success";
                    $transaction->activation_status = "pending";
                    $transaction->board=1;
                    $transaction->date=$date;
                    $transaction->save();
            
                   //-----------
                }
            }

            //-------------------Start sms
             $message = urlencode('Thank you for your purchase from UNIQCONNECT WC! Order ID: '.$oo.' Product: {#var#} Amount: ₹'.$tt.' Need help? Contact us at 000 ');

            
                 $url = "http://site.ping4sms.com/api/smsapi?key=d2c26b4873e847d632ca95f21abfafea&route=2&sender=UNIQWC&templateid=1707174558071253063&number={$mobile}&sms={$message}";

                        $response = Http::get($url);
                        $responseBody = $response->body();
                         if ($response->successful()) {
            
                         }
            //------------------End sms

            // ✅ Step 5: Redirect to success page
 return redirect('/checkpayment?id='.$transactionId)->with('success', 'Order placed successfully..!');
            // return view('payment.success', ['order' => $order]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Order not found.'
        ], 404);
    }

    // ❌ If payment failed or pending
     return redirect('/checkpayment?id='.$transactionId)->with('error', 'Payment not completed..!');
     
    // return view('payment.failed', [
    //     'message' => $statusResponse['message'] ?? 'Payment not completed.',
    //     'transactionId' => $transactionId
    // ]);
}

    public function checkpayment(Request $request){
    
    
       $transactionId = $request->id;

    // ✅ Step 1: Call PhonePe status API (or receive status directly)
    $paymentstatus = $this->handleStatus($transactionId); // or get from request
    
    return view('paymentstatus', compact('paymentstatus'));
    
}

    public function Upgrade_account(Request $request){
    //          $request->validate([
    //     'cart' => 'required|array',
    //     'total' => 'required|numeric',
    //     'grand_total' => 'required|numeric',
    //     'totalPV' => 'required|numeric',
    //     'delivery_charge' => 'required|numeric',
    //     'totalWallet' => 'required|numeric',
    //     'address_id' => 'required|integer',
    // ]);

      $userId = Auth::user()->memberid;
    $orderId = 'UG-' . time() . rand(100, 999);
    $redirectUrl = 'https://uniqconnectwc.com/checkUpgradeStatus?transactionId='.$orderId; // Define this route
    $redirectUrl_Err = 'https://uniqconnectwc.com/checkpayment?id='.$orderId; 

     $amount = 1600;

    $data = [
        'merchantId' => 'M22GQ40FO5WRR',
        'merchantTransactionId' => $orderId,
        'merchantUserId' => $userId,
        'amount' => $amount * 100,
        'redirectUrl' => $redirectUrl,
        'redirectMode' => 'GET',
        'callbackUrl' => $redirectUrl_Err,
        'mobileNumber' => Auth::user()->mobile ?? '0000000000',
        'paymentInstrument' => [
            'type' => 'PAY_PAGE',
        ],
    ];

    $encode = base64_encode(json_encode($data));
    $saltKey = 'db1c9b6e-62e7-41e3-a066-830b52ce2fd9';
    $saltIndex = 1;
    $string = $encode . '/pg/v1/pay' . $saltKey;
    $sha256 = hash('sha256', $string);
    $finalXHeader = $sha256 . '###' . $saltIndex;

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.phonepe.com/apis/hermes/pg/v1/pay',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'X-VERIFY: ' . $finalXHeader
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        return response()->view('error', ['message' => 'Payment initiation failed: ' . $err], 500);
    }

    $rData = json_decode($response);
 $loginToken = Str::random(40);
    if (isset($rData->success) && $rData->success && isset($rData->data->instrumentResponse->redirectInfo->url)) {
        // ✅ Insert order in DB (status: temp)
        $order = payments::create([
            'order_id' => $orderId,
            'user_id' => $userId,
            'amount' => $amount,
            'status' => 'pending',
            'login_token' => $loginToken, 

        ]);


    
        // ✅ Redirect to PhonePe payment page
        return redirect()->away($rData->data->instrumentResponse->redirectInfo->url);



    } else {
        $errorMessage = $rData->message ?? 'An error occurred! Please try again.';
        return response()->view('error', ['message' => $errorMessage], 500);
    }
        }

   public function placeOrder_bk(Request $request)
    {
        $cart = $request->input('cart');
        $total = $request->input('total');
        $grand_total = $request->input('grand_total');
        $userId =  $user_id = Auth::user()->memberid;
        $addressId = $request->input('address_id');
        $totalPV = $request->input('totalPV');
         $delivery_charge = $request->input('delivery_charge');
     $totalWallet = $request->input('totalWallet');
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
            'address_id' => $addressId,
        ]);

        // Step 2: Insert cart items
        foreach ($cart as $item) {
             if ($item['qty'] > 0) { 
            Orders_items::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'quantity'   => $item['qty'],
                'price'      => $item['price'],
            ]);
            }
        }

        return response()->json(['message' => 'Order placed successfully!', 'order_id' => $order->order_id]);
    }
    
    public function order_cancel($orderId){
            
         
    
   $order = Orders::where('id', $orderId)->first();
    
if ($order) {
    $order->status = 'cancelled'; // or whatever value you want
    $order->save();
    
     $orders_items = Orders_items::where('order_id', $orderId)->get();

foreach ($orders_items as $item) {
    $item->status = 'cancelled';
    $item->save();
}
     return redirect('/Orders')->with('success', 'Order cancelled successfully..!');

}else{
      return redirect('/Orders')->with('success', 'Invaild OrderId!');
    
    }
   
   
    //   return view('ordertrack', compact('orders','orders_items'));
    }

private function checkEligibleBoostersIncome($orderItem, $userId)
{
    // SPL or quantity must be valid
    if ($orderItem->spl <= 0 || $orderItem->quantity <= 0) {
        return;
    }

    // Step 1: Calculate count
    $count = $orderItem->spl * $orderItem->quantity;

    // Step 2: Every 2 count = 1 booster
    $eligibleBoosters = intdiv($count, 2);

    if ($eligibleBoosters <= 0) {
        return;
    }

    // Step 3: Total payout
    $totalPayout = $eligibleBoosters * 1000;
    
    
     $mlm_plan = mlm_plan::where('memberid', $userId)->first();

    // Step 4: Insert booster income
    booster_income::create([
        'memberid' => $mlm_plan->sponsor_id,
        'fromId'   => $userId,
        'payout'   => $totalPayout,
        'netpay'   => $totalPayout,
        'eldate'   => Carbon::now(),
    ]);
}

private function processBoosterIncome($order, $userId)
{
    // STEP 1: Get SPL count from current order
    $orderItems = Orders_items::where('order_id', $order->id)
        ->where('spl', 1)
        ->get();

    $currentSpl = 0;
    foreach ($orderItems as $item) {
        $currentSpl += $item->quantity;
    }

    // No SPL → nothing to do
    if ($currentSpl == 0) {
        return;
    }

    // STEP 2: Get sponsor
    $mlm_plan = mlm_plan::where('memberid', $userId)->first();
    if (!$mlm_plan) {
        return;
    }

    // STEP 3: Get waiting booster (inactive)
    $waitingBooster = booster_income::where('fromId', $userId)
        ->where('status', 0) // waiting
        ->first();

    // STEP 4: Merge SPL count
    $totalSpl = $currentSpl;
    if ($waitingBooster) {
        $totalSpl += $waitingBooster->spl_count;
    }

    // STEP 5: Decide payout
    $payout = 0;
    $status = 0;

    if ($totalSpl >= 2 && $totalSpl < 4) {
        $payout = 1000;
        $status = 1; // active
    } elseif ($totalSpl >= 4) {
        $payout = 2000;
        $status = 1; // active
    }

    // STEP 6: Activate or keep waiting
    if ($status === 1) {

        // Activate booster
        if ($waitingBooster) {
            $waitingBooster->update([
                'memberid'  => $mlm_plan->sponsor_id,
                'payout'    => $payout,
                'netpay'    => $payout,
                'status'    => 1,
                'spl_count' => $totalSpl,
                'eldate'    => Carbon::now(),
            ]);
        } else {
            booster_income::create([
                'memberid'  => $mlm_plan->sponsor_id,
                'fromId'    => $userId,
                'payout'    => $payout,
                'netpay'    => $payout,
                'status'    => 1,
                'spl_count' => $totalSpl,
                'eldate'    => Carbon::now(),
            ]);
        }

        // Reset for next cycle
        booster_income::create([
            'memberid'  => $mlm_plan->sponsor_id,
            'fromId'    => $userId,
            'payout'    => 0,
            'netpay'    => 0,
            'status'    => 0,
            'spl_count' => 0,
            'eldate'    => Carbon::now(),
        ]);

    } else {

        // Still waiting
        if ($waitingBooster) {
            $waitingBooster->increment('spl_count', $currentSpl);
        } else {
            booster_income::create([
                'memberid'  => $mlm_plan->sponsor_id,
                'fromId'    => $userId,
                'payout'    => 0,
                'netpay'    => 0,
                'status'    => 0,
                'spl_count' => $currentSpl,
                'eldate'    => Carbon::now(),
            ]);
        }
    }
}


}

