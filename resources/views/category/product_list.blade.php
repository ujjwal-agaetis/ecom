<!-- resources/views/category/product_list.blade.php -->
@extends('layouts.app')
@section('content')
@php
$category_id=$products->id;
if($category_id==1){
    $category_img='cloth_default.jpg';
}elseif($category_id==2){
    $category_img='realme_default.jpg';
}else{
    $category_img='grocery.jpg';
}
@endphp
<div class="container">
    <h1>Product Details category wise</h1>
    <div class="row gap-3">
        @foreach($products->product_list as $product)
        <div class="col-3 d-flex align-items-strech">
            <!-- bootstrap cards code here -->
            <div class="card" style="width: 18rem;">
               
                    <img src="{{ asset('img/category/'.$category_img) }}" width="260px" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text">Available Quantity <span class="badge text-bg-primary">{{$product->quantity}}</span></p>

                        <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-primary text-end" role="button">Add to cart</a>
                        @if (!empty($product->quantity))
                        Qty <input type="number" name="quantity" style="width:45px;" value="1">
                        @else
                        <span class="badge text-bg-danger">Out Of Stock</span>
                        @endif
                        <input type="hidden" name="product_name" value="{{$product->name}}">
                        <input type="hidden" name="product_price" value="857">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                    </div>
                
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection






