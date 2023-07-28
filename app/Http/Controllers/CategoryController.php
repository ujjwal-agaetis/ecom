<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
{
    // Fetch all product categories and display them
    // $category = Category::all();
    // return view('category.index', ['category' => $category]);
    
}

public function create()
    {
        // Show a form to create a new product category
        return view('category.create');
    }

public function show($id)
{
    // Your code to show a specific item
}

// public function store(Request $request)
// {
//     // Validate the request data and store the new category in the database
//     'category_name' => 'required',
//     return redirect()->route('category.index')->with('success', 'Category created successfully!');
// }

// public function edit(Category $category)
//     {
//         // Show a form to edit the specified product category
//         $category = category::find($request->id);
//         return view('category.edit', ['category' => $category]);
//     }

    
//     public function update(Request $request, ProductCategory $category)
//     {
//         $validatedData= $request->validate([
//             'category_name' => 'required',
            
//             ]);
//             $product = Product::findOrFail($request->id);
//             $product->update($validatedData);
//             return redirect()->route('category.index')->with('success', 'Category updated successfully.');
//     }

//     public function destroy(ProductCategory $category)
//     {
//         // Delete the specified product category from the database
//         $category->delete();

//         return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
//     }

    
}
