<!-- resources/views/products/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Product Details</h1>

    <table>
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
    </table>

    <a href="{{ route('products.index') }}">Back to Product List</a>
@endsection
