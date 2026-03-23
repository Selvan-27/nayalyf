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
use App\Models\Category;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Orders_items;
use App\Models\address;
use App\Models\payments;

class OrderController extends Controller
{
    
    

    public function shop_id_card(){
         $data=Product::where('is_active',1)->where('id',1)->get();
        
    return view('ecom.cart_id_card', compact('data'));
        
    }
    
    public function shop(){
         $data=Product::where('is_active',1)->where('id','>',5)->get();
        
    return view('ecom.cart', compact('data'));
        
    }

    public function checkout(){
            
                 $user_id = Auth::user()->memberid;
              $data = address::where('user_id',$user_id)->get();
            
        return view('ecom.checkout', compact('data'));}

    public function index(){
        $user_id = Auth::user()->memberid;
        
        $pending = Orders::where('user_id',$user_id)->whereNotIn('status', ['delivered', 'cancelled']) ->latest()->get();
        $delivered = Orders::where('user_id',$user_id)->where('status','delivered') ->latest()->get();
        $cancelled = Orders::where('user_id',$user_id)->where('status','cancelled') ->latest()->get();
        
         return view('ecom.orders', compact('pending','delivered','cancelled'));
    }
    
    public function getOrderItems($orderId){
    //$items = Orders_items::where('order_id', $orderId)->get();
       $items = DB::table('ecom_order_items as oi')
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
    
    return response()->json($items);
    }
    
    public function orderInvoice($orderId){

          $orders = Orders::findOrFail($orderId);
        if (!$orders) {
            return redirect()->back()->with('error', 'Order not found.');
        }

         $customer = User::where('memberid', $orders->user_id)->first();
       //items
         $orderitems =Orders_items::join('ecom_products','ecom_order_items.product_id','=','ecom_products.id')->where('ecom_order_items.order_id',$orderId)->select('ecom_order_items.*','ecom_products.name','ecom_products.HSN','ecom_products.Tax','ecom_products.CGST','ecom_products.SGST')->get();
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
    $redirectUrl = 'https://uniqconnectwc.com/checkPhonePeStatus?transactionId='.$orderId; // Define this route
     $redirectUrl_Err = 'https://uniqconnectwc.com/checkpayment?id='.$orderId; 

     $amount = 1;

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
            'status' => 'temp',
            'mode' => 'Online',
            'order_date' => now(),
            'login_token' => $loginToken, 
            'address_id' => $addressId,
        ]);

        foreach ($cart as $item) {
            if ($item['qty'] > 0) {
                Orders_items::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                ]);
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
            // $order->payment_message = $statusResponse['message'] ?? 'Payment successful';
            $order->save();

            // ✅ Step 4: Auto-login user (optional)
            if ($order->login_token && $order->user_id) {
                $user = User::where('memberid', $order->user_id)->first();

                if ($user) {
                    Auth::login($user);
                }
            }

            // ✅ Step 5: Redirect to success page
 return redirect('/Orders')->with('success', 'Order placed successfully..!');
            // return view('payment.success', ['order' => $order]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Order not found.'
        ], 404);
    }

    // ❌ If payment failed or pending
     return redirect('/Orders')->with('error', 'Payment not completed..!');
     
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
                }
            }

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

     $amount = 1;

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

}

