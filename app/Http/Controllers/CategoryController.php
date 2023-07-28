<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
{
    
    $category = Category::all();
    return view('category.index', ['category' => $category]);
    // return view('products.index', compact('products','category'));
    
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
    $validatedData= $request->validate([

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

    
    public function update(Request $request, Category $category)
    {
        $validatedData= $request->validate([
            'category_name' => 'required',
            
            ]);
            $category = category::findOrFail($request->id);
            $category->update($validatedData);
            return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Delete the specified product category from the database
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }

    
}
