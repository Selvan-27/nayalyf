<?php

namespace App\Http\Controllers;
use App\Models\Product_galleries;
use App\Models\Product_stocks;
use App\Models\Product;
use App\Models\Category;
use App\Models\Option;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // List all categories
    public function index()
    {
        $data = Product::all();
        $categories = Category::all();
        // return response()->json($categories);
         return view('ecom.product', compact('data','categories'));
    }
    
      public function show_options($id)
    {
        
         $data = Option::findOrFail($id);

         return view('ecom.options', compact('data'));
    }
    
        public function upoption_update_valuedate(Request $request){
            
            $id=$request->id;
            $value= $request->value;
        
        $option = Option::findOrFail($id);
        $option->value = $value;
        $option->save();

        return redirect()->back()->with('success', 'value updated successfully.');
        
//  return back()->with(['message' => 'Category updated']);
        //return response()->json(['message' => 'Category updated', 'data' => $category]);
    }
}