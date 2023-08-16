<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', ['categories' => $categories]);
    }

    public function create()
    {
        // Show a form to create a new product category
        $category = Category::all();
        return view('category.create'); 
    }

    public function store(Request $request)
    {
        // Validate the request data and store the new category in the database
        $validatedData = $request->validate([
            'name' => 'required',

        ]);
        Category::create($validatedData);
        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }

    public function edit(Request $request, $id)
    {
        // Show a form to edit the specified product category
        $category = Category::find($request->id);
        return view('category.edit', ['category' => $category]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',

        ]);
        $category = Category::findOrFail($request->id);
        $category->update($validatedData);
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Request $request)
    {
        // Check if the record exists
        $record = Category::find($request->id);
        if ($record) {
            // Record exists, delete it
        $record->delete();

            return 'Category deleted successfully.';
        } else {

            return 'Category not found.';
        }
    }

    public function get_product_list(category $category)
    {
        $products = $category->load('product_list');
        return view('category.product_list',compact('products'));
    }
}

