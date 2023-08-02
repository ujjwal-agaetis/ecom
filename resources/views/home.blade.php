@extends('layouts.app')
@section('content')
<div class="container">
<div class="p-3 bg-info bg-opacity-10 border border-info border-start-0 rounded-end">
        Category
    </div>
    <div class="row">
        @foreach($categories as $category)
            <p><a class="link-opacity-100-hover" href="{{ route('category.show', ['category' => $category->id]) }}">{{ $category->name }}</a></p>
        @endforeach
    </div>
    <br>
    <br>
    <div class="p-3 bg-info bg-opacity-10 border border-info border-start-0 rounded-end">
        Products
    </div>
    <div class="row gap-3">
        @foreach($products as $product)
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
@endsection