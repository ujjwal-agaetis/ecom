<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
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
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $categories= category::all();
        return view('products.create', compact('products','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'status' => 'required',
            'quantity' => 'required|numeric',
            'category_id' => 'required',
            'stock' => 'required',
            'price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            // Return validation errors
            return response()->json(['errors' => $validator->errors()], 422);
        }
        Product::create($validator->validated());
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
        $categories= category::all();
        return view('products.edit', compact('product','categories'));
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
        'price' => 'required|numeric',
        
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