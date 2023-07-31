<!-- resources/views/products/product_list.blade.php -->
@extends('layouts.app')
@section('content')
    <div class="container">
    <h1>Product Details category wise</h1>
    <div class="row gap-3" >
    @foreach($products->product_list as $product)
    <div class="col-3 d-flex align-items-strech">
        <!-- bootstrap cards code here -->
    <div class="card" style="width: 18rem;">
    <img class="card-img-top" src="https://odoo-community.org/web/image/product.template/3936/image_1024?unique=88a9e3e" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text">{{ $product->description }}</p>
        <a href="#" class="btn btn-primary text-end">Proceed to Book</a>
    </div>
    </div>
    </div>
    @endforeach
    </div>
    </div>
    <a href="{{ route('products.index') }}" name="show">View Product Details</a>
@endsection