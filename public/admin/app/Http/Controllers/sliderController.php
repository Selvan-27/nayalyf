<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class sliderController extends Controller
{
    // List all categories
    public function index()
    {
        $data = Slider::all();
        
          return view('ecom.slider', compact('data'));
        return response()->json($categories);
        
        
    }

    // Show form to create a new category (for web only)
    public function create()
    {
        return view('ecom.slider.create');
    }

    // Store new category
    public function store(Request $request)
    {
     
      
    
    DB::beginTransaction();

    try {
        // Upload main image
        $mainImagePath = $request->file('image_url')->store('sliders', 'public');

        // Insert into ecom_products
        $product = Slider::create([
            'image_url' => $mainImagePath,
            'alt_text'=>$request->alt_text,
        ]);

        DB::commit();
        
        return redirect()->back()->with('success', 'Slider created successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }

   
}
 public function changeStatus(Request $request, $id)
    {
         
      //return  $request->input('status');
      
      $data = Slider::findOrFail($id);
        $data->is_active = $request->input('status') === '1' ? '1' : '0';
        $data->save();


       return response()->json(['message' => 'Status changed successfully']);
    }
    // Update category
    public function update(Request $request, $id)
    {
        
      
         if ($request->hasFile('image_url')) {
        // Delete the old image
        if ($slider->image_url && Storage::disk('public')->exists($slider->image_url)) {
            Storage::disk('public')->delete($slider->image_url);
        }

        // Store the new image
        $slider->image_url = $request->file('image_url')->store('sliders', 'public');
    }

    // Update alt text
    $slider->alt_text = $request->alt_text;

    // Save changes
    $slider->save();
 return back()->with(['message' => 'Slider updated']);
        //return response()->json(['message' => 'Category updated', 'data' => $category]);
    }

    // Delete category
    public function destroy($id)
    {
        $category = Slider::findOrFail($id);
        $category->delete();

        return back()->with(['message' => 'Slider deleted']);
    }
}
