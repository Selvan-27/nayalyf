<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\mlm_plan;
use App\Models\booster_income;
use App\Models\Category;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Orders_items;
use App\Models\address;


class PosController extends Controller
{
    public function index(Request $request)
    {
        
       //return $userid = $request->userid;
        
        $products = Product::where('is_active', 1)->get();
        $customers = User::get();

       return view('pos.index', compact('products', 'customers'));
    }

    public function processOfflineBill(Request $request)
    {
        //return $request->all();
        // $request->validate([
        //     'customer_id' => 'required|exists:users,id',
        //     'products' => 'required|array',
        //     'products.*.product_id' => 'required|exists:products,id',
        //     'products.*.quantity' => 'required|numeric|min:1',
        //     'discount' => 'nullable|numeric|min:0',
        // ]); 
       
    //  return  $productData=$request->product;
    
$order_id = 'ORD-' . time() . rand(100, 999);

$order = new Orders();
$order->order_id = $order_id;
$order->user_id = $request->user_id;
$order->payment_method = $request->payment_method;
$order->order_date = Carbon::now(); // if you want to store order date
$order->status = 'delivered';
$order->mode = 'Offline';
$order->total = 0; // initialize
$order->PV = 0; // initialize
$order->discount = $request->discount ?? 0;
$order->remarks = $request->Remarks;
$order->short_address = $request->short_address;

$order->save(); // 🔹 save first to generate $order->id

$totalAmount = 0;
$totalsumPV  = 0;

$products   = $request->input('product_id', []);
$quantities = $request->input('qty', []);
$rates      = $request->input('rate', []);

foreach ($products as $index => $productId) {

    $product  = Product::findOrFail($productId);

    $quantity = isset($quantities[$index]) ? (int)$quantities[$index] : 1;
    $price    = isset($rates[$index]) ? (float)$rates[$index] : $product->price;
    $pv       = $product->pv;

    if ($quantity <= 0) {
        continue;
    }

    $totalAmount += $price * $quantity;
    $totalsumPV  += $pv * $quantity;

    // Only product ID 3 or 4
    if (in_array($productId, [3, 4])) {

        // Main product
        Orders_items::create([
            'order_id'        => $order->id,
            'product_id'      => $productId,
            'product_sub_id'  => $product->main_product,
            'quantity'        => $product->m_qty,
            'price'           => $product->price,
        ]);

        // Offer product (free)
        Orders_items::create([
            'order_id'        => $order->id,
            'product_id'      => $productId,
            'product_sub_id'  => $product->offer_product,
            'quantity'        => $product->o_qty,
            'price'           => 0,
        ]);

    } else {

        // Normal products
        Orders_items::create([
            'order_id'   => $order->id,
            'product_id' => $productId,
            'quantity'   => $quantity,
            'price'      => $price,
            'spl'        => $product->spl,
        ]);
    }
}

      
       
        
        
// foreach ($products as $index => $productId) {
//     $product = Product::findOrFail($productId);
//     $quantity = isset($quantities[$index]) ? $quantities[$index] : 1;
//     $price = isset($rates[$index]) ? $rates[$index] : $product->price;
//         $pv = isset($rates[$index]) ? $rates[$index] : $product->pv;
//     $totalPrice = $price * $quantity;
//     $totalPV = $pv * $quantity;
    

//             if ($quantity > 0) {
//     // Create order item
//     $orderItem = new Orders_items();
//     $orderItem->order_id = $order->id;
//     $orderItem->product_id = $product->id;
//     $orderItem->quantity = $quantity;
//     $orderItem->price = $price; // use the price used for calculation
//     $orderItem->total_price = $totalPrice;
//     $orderItem->save();
//     }
//     $totalAmount += $totalPrice;
//     $totalsumPV+=$totalPV;
// }

// Update order total amount
$order->total = $totalAmount - $order->discount;
$order->payable = $totalAmount - $order->discount;
$order->PV = $totalsumPV;


$order->save();

                    //-------------------Start
                       
 $orderItems = Orders_items::where('order_id', $order->id)
    ->where('spl', 1)
    ->get();

$userId = $order->user_id;

foreach ($orderItems as $orderItem) {
    
    //-------------------Start booster
        // Step 1: Calculate count
        
                           
//  $orderItems = Orders_items::where('order_id', $order->id)
//     ->where('spl', 1)
//     ->get();
    
//     $count = $orderItem->spl * $orderItem->quantity;

//     // Step 2: Every 2 count = 1 booster
//     $eligibleBoosters = intdiv($count, 2);

//     if ($eligibleBoosters <= 0) {
//         return;
//     }

//     // Step 3: Total payout
//     $totalPayout = $eligibleBoosters * 1000;
    

//      $mlm_plan = mlm_plan::where('memberid', $userId)->first();
     
//     // Step 4: Insert booster income
//     booster_income::create([
//         'memberid' => $mlm_plan->sponsor_id,
//         'fromId'   => $userId,
//         'payout'   => $totalPayout,
//         'netpay'   => $totalPayout,
//         'eldate'   => Carbon::now(),
//     ]);

    //-------------------end booster
   // $this->checkEligibleBoostersIncome($orderItem, $userId);
   
   $this->processBoosterIncome($order, $userId);

}


                     //-------------------Start sms
        
        return redirect('/order-list')->with('success', 'Offline bill processed successfully!');
    }


    public function orderlist()
    {
        $orders = Orders::where('mode','Offline')->latest()->get();
        return view('pos.order_list', compact('orders'));
    }

    // public function orderInvoice($orderId)
    // {
    //     $order = Orders::findOrFail($orderId);
    //     return view('ecom.order_invoice', compact('order'));
    // }
    
       public function orderInvoice($orderId)
{
    // Get order (will auto-throw 404 if not found)
    $orders = Orders::findOrFail($orderId);

    // Get customer
    $customer = User::where('memberid', $orders->user_id)->first();

    // Get order items with product details
    $orderitems =Orders_items::join('ecom_products','ecom_order_items.product_id','=','ecom_products.id')->where('ecom_order_items.order_id',$orderId)->get();

    // Get address if exists
    $address = null;
    if (!empty($orders->address_id)) {
        $address = address::find($orders->address_id);
    }

    return view('pos.invoice', compact(
        'orderitems',
        'customer',
        'orders',
        'address'
    ));
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
    