<!-- resources/views/products/product_list.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Product Details category wise</h1>
    <div class="row gap-3">
        @foreach($products->product_list as $product)
        <div class="col-3 d-flex align-items-strech">
            <!-- bootstrap cards code here -->
            <div class="card" style="width: 18rem;">
                <form class="add_cart_form_{{$product->id}}">
                    @csrf
                    <img class="card-img-top" src="https://odoo-community.org/web/image/product.template/3936/image_1024?unique=88a9e3e" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <button class="btn btn-primary text-end add_to_cart" data-id="{{$product->id}}">Add to cart</button>
                        Qty <input type="number" name="quantity" style="width:45px;" value="1">
                        <input type="hidden" name="product_name" value="{{$product->name}}">
                        <input type="hidden" name="product_price" value="456">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
<a href="{{ route('products.index') }}" name="show">View Product Details</a>
<script type="module">
    $(document).ready(function() {
        // add cart action for category
        $('.add_to_cart').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: '/add_product_to_cart',
                type: 'post',
                data: $('.add_cart_form_'+id).serialize(),
                success: function(response) {
                    // Handle the response
                    //console.log(response);
                    alert('Product Added to the cart successfully!');
                }
            });
        });
    });
</script>
@endsection