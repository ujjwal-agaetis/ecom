<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        $products = Product::all();
        return view('products.index', compact('products','category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validatedData= $request->validate([
        'name' => 'required',
        'slug' => 'required',
        'description' => 'required',
        'status' => 'required',
        'quantity' => 'required|numeric',
        'category_id' => 'required',
        'stock' => 'required',
        
        ]);
        product::create($validatedData);
        return redirect()->route('products.index')->with('success', 'product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $product = Product::find($request->id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request)
    {
       $validatedData= $request->validate([
        'name' => 'required',
        'slug' => 'required',
        'description' => 'required',
        'status' => 'required',
        'quantity' => 'required|numeric',
        'category_id' => 'required',
        'stock' => 'required',
        ]);
        $product = Product::findOrFail($request->id);
        $product->update($validatedData);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(Request $request)
    {
        // Check if the record exists
        $record = Product::find($request->id);
        if ($record) {
            // Record exists, delete it
            $record->delete();
            
            return 'Record deleted successfully.';
        } else {
            
            return 'Record not found.';
        }
    }

  
}