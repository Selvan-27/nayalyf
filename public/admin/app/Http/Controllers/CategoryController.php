<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // List all categories
    public function index()
    {
        $data = Category::all();
        
          return view('procat', compact('data'));
        return response()->json($categories);
        
        
    }

    // Show form to create a new category (for web only)
    public function create()
    {
        return view('ecom_categories.create');
    }

    // Store new category
//     public function store(Request $request){
//         $request->validate([
//             'name' => 'required|max:255',
//         ]);

//           $category= Category::create([
             
//     'name' => $request->name,
// ]);


//       return back()->with(['message' => 'Category created']);
//     }

public function store(Request $request)
{
    // $request->validate([
    //     'name'  => 'required|max:255',
    //     'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    // ]);

    $imagePath = null;
//return $request->image;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('category', 'public');
    }

    Category::create([
        'name'  => $request->name,
        'image' => $imagePath,
    ]);

    return back()->with('message', 'Category created');
}

    // Edit a category (for web form)
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('ecom_categories.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->only(['name', 'description', 'is_active']));
 return back()->with(['message' => 'Category updated']);
        //return response()->json(['message' => 'Category updated', 'data' => $category]);
    }

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with(['message' => 'Category deleted']);
    }
}
