<?php

namespace App\Http\Controllers;
use App\Models\Product_galleries;
use App\Models\Product_stocks;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    // List all categories
    public function stock_list()
    {
        $products = Product::get();     
        
        $stocks_list = Product_stocks::select('ecom_products.name as name', 'ecom_stocks.*')
        ->join('ecom_products', 'ecom_stocks.product_id', '=', 'ecom_products.id')
        ->orderBy('ecom_products.name', 'asc')
        ->get();
        
       $stockSub = DB::table('ecom_stocks')
    ->select(
        'product_id',
        DB::raw('SUM(quantity) as total_stock')
    )
    ->groupBy('product_id');

$orderSub = DB::table('ecom_order_items')
    ->select(
        'product_id',
        DB::raw('SUM(quantity) as ordered_qty')
    )
    ->groupBy('product_id');

 $data = DB::table('ecom_products')
      ->where('ecom_products.id', '>', 5) 
    ->leftJoinSub($stockSub, 'stocks', function ($join) {
        $join->on('stocks.product_id', '=', 'ecom_products.id');
    })
    ->leftJoinSub($orderSub, 'orders', function ($join) {
        $join->on('orders.product_id', '=', 'ecom_products.id');
    })
    ->select(
        'ecom_products.id as product_id',
        'ecom_products.name as product_name',
        DB::raw('COALESCE(stocks.total_stock, 0) as total_stock'),
        DB::raw('COALESCE(orders.ordered_qty, 0) as ordered_qty'),
        DB::raw('(COALESCE(stocks.total_stock, 0) - COALESCE(orders.ordered_qty, 0)) as available_qty')
    )
    ->get();



//  $data = Product_stocks::select('ecom_products.name as product_name', DB::raw('SUM(ecom_stocks.quantity) as total_qty'))
  //      ->join('ecom_products', 'ecom_stocks.product_id', '=', 'ecom_products.id')
    //    ->groupBy('ecom_products.name')
      //  ->get();
        return view('ecom.stock', compact('data', 'products','stocks_list'));
    }

    public function update_stock(Request $request)
    {
        // $request->validate([
        //     'product_id' => 'required|exists:ecom_products,id',
        //     'quantity' => 'required|integer|min:1',
        //     'mfg_name' => 'required|string|max:255',
        //     'mfg_date' => 'required|date',
        //     'exp_date' => 'required|date|after_or_equal:mfg_date',
        //     'batch_no' => 'required|string|max:255',
        // ]);

        $stock = new Product_stocks();
        $stock->product_id = $request->product_id;
        $stock->quantity = $request->quantity;
        $stock->mfg_name = $request->mfg_name;
        $stock->mfg_date = $request->mfg_date;
        $stock->exp_date = $request->exp_date;
        $stock->batch_no = $request->batch_no;
        $stock->save();

        return redirect()->back()->with('success', 'Stock updated successfully.');
    }

    public function delete_stock($id)
    {
        $stock = Product_stocks::findOrFail($id);
        $stock->delete();

        return redirect()->back()->with('success', 'Stock deleted successfully.');
    }

}