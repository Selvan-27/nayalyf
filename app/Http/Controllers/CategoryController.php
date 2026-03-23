<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // List all categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Show form to create a new category (for web only)
    public function create()
    {
        return view('ecom_categories.create');
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = Category::create($request->only(['name', 'description', 'is_active']));

        return response()->json(['message' => 'Category created', 'data' => $category], 201);
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

        return response()->json(['message' => 'Category updated', 'data' => $category]);
    }

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted']);
    }
}
