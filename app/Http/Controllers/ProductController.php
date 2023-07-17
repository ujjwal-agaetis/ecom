<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
    $products = Product::all();
    return view('products.index', compact('products'));
   }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('products.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validatedData = $request->validate([
    'name' => 'required',
    'slug' => 'required|unique:products',
    'description' => 'required',
    'status' => 'required',
    'quantity' => 'required|integer',
    ]);
        
    product::create($validatedData);
    return redirect()->route('products.index')->with('success','product created successfully.');
       
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
    
        
    public function update(Request $request, $id)
    {
    $request->validate([
    'name' => 'required',
    'slug' => 'required',
    'description' => 'required',
    'status' => 'required',
    'quantity' => 'required|numeric',
    'stock' => 'required',
    ]);

    $product = Product::findOrFail($id);
    $product->name = $request->input('name');
    $product->slug = $request->input('slug');
    $product->description = $request->input('description');
    $product->status = $request->input('status');
    $product->quantity = $request->input('quantity');
    $product->stock = $request->input('stock');
    $product->save();

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    

    public function destroy(Request $request )
    {
        info($request->all());
        $product = Product::find($request->id)->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');

    }
}
