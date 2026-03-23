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
use App\Models\Category;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Orders_items;


class OrderController extends Controller
{
    
    public function index(Request $request){

     $type= $request->type ? $request->type : 0;
     
     $st= $request->status ? $request->status : "pending";
          
if($type==0){
               
        $data = DB::table('ecom_orders')
    ->join('users', 'ecom_orders.user_id', '=', 'users.memberid')
    ->where('ecom_orders.status',$request->status)
    ->select('ecom_orders.*', 'users.name as name', 'users.mobile as mobile')
    ->orderByDesc('ecom_orders.created_at')
    ->get();

               
}else{
              
    $pending = DB::table('ecom_orders')
    ->join('users', 'ecom_orders.user_id', '=', 'users.memberid')
    ->where('ecom_orders.status','pending')
    ->where('ecom_orders.id',$type)
    ->select('ecom_orders.*', 'users.name as name', 'users.mobile as mobile')
    ->orderByDesc('ecom_orders.created_at')
    ->get();

        $delivered = DB::table('ecom_orders')
    ->join('users', 'ecom_orders.user_id', '=', 'users.memberid')
    ->where('ecom_orders.status','delivered')
        ->where('ecom_orders.id',$type)
    ->select('ecom_orders.*', 'users.name as name', 'users.mobile as mobile')->orderByDesc('ecom_orders.created_at')->get();
    
      $cancelled = DB::table('ecom_orders')
    ->join('users', 'ecom_orders.user_id', '=', 'users.memberid')
    ->where('ecom_orders.status','cancelled')
        ->where('ecom_orders.id',$type)
    ->select('ecom_orders.*', 'users.name as name', 'users.mobile as mobile')->orderByDesc('ecom_orders.created_at')->get();
              
          }


        // $delivered = Orders::where('status','delivered') ->latest()->get();
        // $cancelled = Orders::where('status','cancelled') ->latest()->get();
        
         return view('ecom.orders', compact('data'));
    }
    public function order_update(Request $request, $orderId)
    {
        $st=$request->input('order_status');
        $order = Orders::findOrFail($orderId);
        $order->status = $request->input('order_status');
        $order->updated_at = Carbon::now();
        $order->pnr_number = $request->input('pnr_number');
        $order->courier_name = $request->input('courier_name');
        $order->track_link = $request->input('tracking_number');
        $order->delivery_date = $request->input('delivery_date');
        $order->save();

            
         return redirect('orders?status='.$st)->with('success', 'Order status updated successfully!');
    }
    public function getOrderItems($orderId)
    {
    //$items = Orders_items::where('order_id', $orderId)->get();
      return $items = DB::table('ecom_order_items as oi')
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
    
    public function orderTrack($orderId)
    {
        
    $orders = Orders::where('order_id', $orderId)->first();
    // $orders_items = Orders_items::where('order_id', $orders->order_id)->get();
    $orderId =$orders->order_id;
    return $orderItems = DB::table('ecom_order_items as oi')
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


      return view('ordertrack', compact('orders','orders_items'));
    }

   public function placeOrder(Request $request)
    {
        $cart = $request->input('cart');
        $total = $request->input('total');
        $userId = $request->input('user_id');
        $addressId = $request->input('address_id');
        $delivery_charge = $request->input('delivery_charge');

        // Step 1: Create the order
        $order = Orders::create([
            // 'order_id'   => strtoupper(Str::random(10)),
            'order_id' =>rand(10000000, 99999999),
            'user_id'    => $userId,
            'total'      => $total,
            'status'     => 'pending',
            'address_id' => $addressId,
            'delivery_charges' => $delivery_charge,
        ]);

        // Step 2: Insert cart items
        foreach ($cart as $item) {
            Orders_items::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'quantity'   => $item['qty'],
                'price'      => $item['price'],
            ]);
        }

        return response()->json(['message' => 'Order placed successfully!', 'order_id' => $order->order_id]);
    }

    public function orderInvoice($orderId)
    {
        $order = Orders::where('order_id', $orderId)->first();
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

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
            ->where('oi.order_id', $order->id)
            ->get();
            
              if($orders['address_id']){
                 $address = address::findOrFail($orders['address_id']);
}
        return view('ecom.order_invoice', compact('order', 'orderItems','address'));
    }
  
  
  public function sales_report(){
        
   $products = DB::table('ecom_products')->get();  // Get all products
    $report = DB::table('ecom_orders as o')
        ->join('users as u', 'o.user_id', '=', 'u.memberid')
        ->join('ecom_order_items as ei', 'o.id', '=', 'ei.order_id')
        ->select(
            DB::raw('DATE(o.created_at) as Date'),
            'u.name as Member',
            'u.memberid',
             'o.total as Payment'
        );

    // Dynamically add columns for each product
    foreach ($products as $product) {
        $report->addSelect(
            DB::raw("SUM(CASE WHEN ei.product_id = {$product->id} THEN ei.quantity ELSE 0 END) AS product{$product->id}_qty"),
            DB::raw("SUM(CASE WHEN ei.product_id = {$product->id} THEN ei.price ELSE 0 END) AS product{$product->id}_price")
        );
    }

    // Apply filters and group by order date and user
    $report->where('o.status', 'delivered')
        ->groupBy(DB::raw('DATE(o.created_at)'), 'u.memberid','u.name','o.total')
        ->orderByDesc(DB::raw('DATE(o.created_at)'));

 $reportData = $report->get();

    return view('ecom.sales_report', compact('reportData', 'products')); // Pass data to view

  }
  
}
