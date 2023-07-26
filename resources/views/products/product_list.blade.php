<!-- resources/views/products/product_list.blade.php -->
@extends('layouts.app')
@section('content')
    <h1>Product Details category wise</h1>
    {{dd($products)}}
    <table>
        
    @foreach($products->products as $product)

        <tr>
            <th>Name:</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>Slug:</th>
            <td>{{ $product->slug }}</td>
        </tr>
        <tr>
            <th>Description:</th>
            <td>{{ $product->description }}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>{{ $product->status }}</td>
        </tr>
        <tr>
            <th>Quantity:</th>
            <td>{{ $product->quantity }}</td>
        </tr>
        @endforeach
    </table>
    <a href="{{ route('products.index') }}" name="show">Back to Product List</a>
@endsection