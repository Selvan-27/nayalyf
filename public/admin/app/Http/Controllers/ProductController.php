<?php

namespace App\Http\Controllers;
use App\Models\Product_galleries;
use App\Models\Product_stocks;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // List all categories
    public function index()
    {
        $data = Product::where('id','>',5)->get();
        
        // $business_list = Product::where('type','business')->get();
        $categories = Category::all();
        // return response()->json($categories);
         return view('ecom.product', compact('data','categories'));
    }

    // Show form to create a new category (for web only)
    public function create()
    {
          $categories = Category::all();
        return view('ecom.product_add', compact('categories'));
    }

    // Store new category
    public function store(Request $request)
    {
    //     $request->validate([
    //     'name' => 'required|string|max:255',
    //     'description' => 'required|string',
    //     'price' => 'required|numeric',
    //     'mrp' => 'nullable|numeric',
    //     'pv' => 'nullable|numeric',
    //     'tag' => 'nullable|string',
    //     'category_id' => 'nullable|integer',
    //     'is_active' => 'required|boolean',
    //     'main_image' => 'required|image',
    //     'images.*' => 'image|nullable',
    //     'quantity' => 'required|integer|min:0',
    // ]);

     $cid=$request->category_id;
  
   $Category = Category::findOrFail($request->category_id);


 
    DB::beginTransaction();

    try {
        // Upload main image
        $mainImagePath = $request->file('main_image')->store('products', 'public');

        // Insert into ecom_products
        $product = Product::create([
            'type' => $request->producttype,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'mrp' => $request->mrp,
            'pv' => $request->pv,
            'HSN' => $request->HSN,
            'TAX' => $request->TAX,
            'CGST' => $request->CGST,
            'SGST' => $request->SGST,
            'dc' => $request->dc,
            'discount' => $request->discount,
            'tag' => $request->tag,
            'category_id' => $request->category_id,
            'category' =>$Category->name,
            'is_active' => $request->is_active,
            'image_url' => $mainImagePath,
        ]);

        // Insert main image in product_images
        $mainImage = Product_galleries::create([
            'product_id' => $product->id,
            'image_url' => $mainImagePath,
            'alt_text' => $product->name,
        ]);

        // Insert additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('products', 'public');
                Product_galleries::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                    'alt_text' => '',
                ]);
            }
        }

        // Insert into ecom_stock
        // Product_stocks::create([
        //     'product_id' => $product->id,
        //     'quantity' => $request->quantity,
        // ]);

        DB::commit();
        return redirect()->back()->with('success', 'Product created successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }

        // return back()->with(['message' => 'Product Added']);
    }

    // Edit a category (for web form)
    public function edit($id)
    {     $categories = Category::all();
        $data = Product::findOrFail($id);
        return view('ecom.product_edit', compact('data','categories'));
    }


    public function offer_page_edit2($id)
    {    
        
        $categories = Category::all();
        $products = Product::where('id','>','5')->get();
        
            $data = Product::findOrFail($id);
        return view('ecom.product_edit2', compact('data','categories','products'));
    }


    // Update category
    public function update(Request $request, $id)
    {
   
      $data = Product::with(['stock', 'galleries', 'category'])
                   ->findOrFail($id);
                     $categories = Category::all();

    // Find product
    $product = Product::findOrFail($id);
    $Category = Category::findOrFail($request->category_id);
//  return $coverImagePath = $request->file('cover_img');
    // Update product details
    $product->update([
        'type'        => $request->producttype,
        'name'        => $request->name,
        'description' => $request->description,
        'price'       => $request->price,
        'mrp'         => $request->mrp,
        'pv'          => $request->pv,
        'HSN'       => $request->HSN,
         'CGST'       => $request->CGST,
         'SGST'       => $request->SGST,
        'TAX'       => $request->TAX,
          'dc' => $request->dc,
        'tag'         => $request->tag,
        'category_id' => $request->category_id,
        'category'    => $Category->name,
        'is_active'   => $request->is_active,
    ]);

    // Update main image if uploaded
    if ($request->hasFile('main_image')) {
        // delete old main image if exists
        // return $request->main_image;
        if ($product->image_url && \Storage::disk('public')->exists($product->image_url)) {
            \Storage::disk('public')->delete($product->image_url);
        }


        $mainImagePath = $request->file('main_image')->store('products', 'public');
        $product->image_url = $mainImagePath;
        $product->save();

        // Update / replace main image in galleries
        $mainImage = Product_galleries::where('product_id', $product->id)->first();
        if ($mainImage) {
            $mainImage->update([
                'image_url' => $mainImagePath,
                'alt_text'  => $product->name,
            ]);
        } else {
            Product_galleries::create([
                'product_id' => $product->id,
                'image_url'  => $mainImagePath,
                'alt_text'   => $product->name,
            ]);
        }
    }

    // Add new additional images if uploaded
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $path = $img->store('products', 'public');
            Product_galleries::create([
                'product_id' => $product->id,
                'image_url'  => $path,
                'alt_text'   => '',
            ]);
        }
    }

    // Update stock (if record exists, update; else create)
   

    return redirect('/products')->with('success', 'Product updated successfully!');
}

    public function update2(Request $request, $id)
    {
   
      $data = Product::with(['stock', 'galleries', 'category'])
                   ->findOrFail($id);
                     $categories = Category::all();

    // Find product
    $product = Product::findOrFail($id);
    $Category = Category::findOrFail($request->category_id);
//  return $coverImagePath = $request->file('cover_img');
    // Update product details
    $product->update([
        'type'        => $request->producttype,
        'name'        => $request->name,
        'description' => $request->description,
        'price'       => $request->price,
        'mrp'         => $request->mrp,
        'pv'          => $request->pv,
        'HSN'       => $request->HSN,
         'CGST'       => $request->CGST,
         'SGST'       => $request->SGST,
        'TAX'       => $request->TAX,
        'tag'         => $request->tag,
        'category_id' => $request->category_id,
        'category'    => $Category->name,
        'is_active'   => $request->is_active,
    ]);

    // Update main image if uploaded
    if ($request->hasFile('main_image')) {
        // delete old main image if exists
        // return $request->main_image;
        if ($product->image_url && \Storage::disk('public')->exists($product->image_url)) {
            \Storage::disk('public')->delete($product->image_url);
        }

   

        $mainImagePath = $request->file('main_image')->store('products', 'public');
        $product->image_url = $mainImagePath;
    }
    
        if ($request->hasFile('cover_img')) {
        // delete old main image if exists
        // return $request->main_image;
        if ($product->cover_img && \Storage::disk('public')->exists($product->cover_img)) {
            \Storage::disk('public')->delete($product->cover_img);
        }


             if ($request->hasFile('cover_img')) {
                $coverImagePath = $request->file('cover_img')->store('products', 'public');
                 $product->cover_img = $coverImagePath;
            }
    
}      

$product->save();


    // Update stock (if record exists, update; else create)
   
    return back()->with('success', 'Product updated successfully!');
}
        public function changeStatus(Request $request, $id)
    {
         
      //return  $request->input('status');
      
      $data = Product::findOrFail($id);
        $data->is_active = $request->input('status') === '1' ? '1' : '0';
        $data->save();


       return response()->json(['message' => 'Status changed successfully']);
    }
  

    // Delete category
    public function destroy($id)
    {
        $data = Product::findOrFail($id);
        $data->delete();

        return back()->with(['message' => 'Product deleted']);
    }
}
