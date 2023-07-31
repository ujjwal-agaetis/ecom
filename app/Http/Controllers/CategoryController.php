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
        $category = category::all();
        return view('category.create');
    }

    public function show($id)
    {
        // Your code to show a specific item
    }

    public function store(Request $request)
    {
        // Validate the request data and store the new category in the database
        $validatedData = $request->validate([
            'category_name' => 'required',

        ]);
        category::create($validatedData);
        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }

    public function edit(Request $request, $id)
    {
        // Show a form to edit the specified product category
        $category = category::find($request->id);
        return view('category.edit', ['category' => $category]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required',

        ]);
        $category = category::findOrFail($request->id);
        $category->update($validatedData);
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Request $request)
    {
        // Check if the record exists
        $record = category::find($request->id);
        if ($record) {
            // Record exists, delete it
        $record->delete();

            return 'Category deleted successfully.';
        } else {

            return 'Category not found.';
        }
    }

    public function get_product_list($id)
    {
        $products=category::where('id',$id)->with('product_list')->first();
        return view('category.product_list',compact('products'));
    }
}
