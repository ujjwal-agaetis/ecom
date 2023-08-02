@extends('layouts.app')
@section('content')
<div class="container">
    <form id="update_product_form">
        @csrf

        <input type="hidden" name="id" value="{{$product->id}}">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$product->name}}" placeholder="">
        </div>

        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="slug" class="form-control" id="slug" name="slug" value="{{$product->slug}}" placeholder="">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" id="description">{{$product->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" class="form-control" id="status">
                <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $product->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>

        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" name="quantity" id="quantity" value="{{$product->quantity}}">

        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" class="form-control" id="category_id">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                <option value="{{$cat->id}}" {{ $cat->id === $product->category_id ? 'selected' : '' }}>{{$cat->category_name}}</option>

                @endforeach
            </select>
            </div>


            <div class="form-group">
                <label for="stock">Availability:</label>
                <select name="stock" class="form-control" id="stock">
                    <option value="in-stock" {{ $product->stock === 'in-stock' ? 'selected' : '' }}>In Stock</option>
                    <option value="sold-out" {{ $product->stock === 'sold-out' ? 'selected' : '' }}>Sold Out</option>
                </select>

            </div>
            </br>

            <button type="submit" name="submit" class="btn btn-primary edit_product">Edit</button>

    </form>

</div>

<script type="module">
    $(document).ready(function() {

        // Update action
        $('#update_product_form').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },

                slug: {
                    required: true,

                },

                description: {
                    required: true,

                },

                rules: {
                    status: {
                        required: true,

                    }
                },
                quantity: {
                    required: true,

                },

                category_id: {
                    required: true,

                },
                // Add more rules for other form fields as needed
            },
            messages: {
                name: {
                    required: "Please enter your name",
                    minlength: "Name must be at least 3 characters"
                },
                slug: {
                    required: "Please enter your Slug Number",

                },

                description: {
                    required: "Please enter your Description Details",
                    description: "Please enter a Description Details"
                },

                status: {
                    required: "Please enter your Status ",

                },

                quantity: {
                    required: "Please enter your product quantity",

                },

                category_id: {
                    required: "Please select Category",

                },
                // Add more custom error messages for other form fields
            },
            submitHandler: function(form) {
                // This function will be called when the form is valid

                $.ajax({
                    url: "/products/update",
                    type: 'post',
                    data: $('#update_product_form').serialize(),
                    success: function(response) {
                        // Handle the response
                        //console.log(response);
                        alert('Product updated successfully!');
                        window.location.replace('/home');
                    }
                });
            }
        });

    })
</script>
@endsection