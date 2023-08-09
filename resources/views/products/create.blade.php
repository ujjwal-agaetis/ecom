@extends('layouts.app')
@section('content')

<div class="container">
  @section('content')
  <h1>Create Product</h1>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif


  <form id="create_product_form" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
      <label for="">Name</label>
      <input type="text" class="form-control" name="name" value="" id="name" placeholder="">
    </div>

    <div class="form-group">
      <label for="slug">Slug</label>
      <input type="slug" class="form-control" id="slug" value="" name="slug" placeholder="">
    </div>

    <div class="form-group">
      <label for="description">Description:</label>
      <textarea name="description" class="form-control" id="description"></textarea>
    </div>

    <div class="form-group">
      <label for="status">Status:</label>
      <select name="status" class="form-control" id="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select>
    </div>

    <div class="form-group">
      <label for="quantity">Quantity:</label>
      <input type="number" class="form-control" name="quantity" id="quantity" value="" min="0" max="10000">
    </div>

    <div class="form-group">
      <label for="category_id">Category:</label>
      <select name="category_id" class="form-control" id="category_id">
        <option value="">Select Category</option>
        @foreach($categories as $cat)
        <option value="{{$cat->id}}">{{$cat->name}}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="stock">Availability:</label>
      <select name="stock" class="form-control" id="stock">
        <option value="in-stock">In Stock</option>
        <option value="sold-out">Sold Out</option>
      </select>
    </div>

    <div class="form-group">
      <label for="price">Price:</label>
      <input type="number" class="form-control" name="price" id="price" value="" >
    </div>

    <div class="form-group">
      <label for="img">Image:</label>
      <input type="file" class="form-control" name="img" id="img" value="">
    </div>
    </br>

    <button type="submit" name="submit" class="btn btn-primary create_product">Create</button>

  </form>

</div>

<script type="module">
  $(document).ready(function() {
    // Create action
    $('#create_product_form').validate({
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

        price: {
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

        price: {
          required: "Please enter your product price",

        },

        // Add more custom error messages for other form fields
      },
      submitHandler: function(form) {
        // This function will be called when the form is valid
        //form.submit(); // Submit the form
        //form_data = $('#create_product_form').serialize();

        $.ajax({
          url: '/products/store',
          type: 'post',
          data: $('#create_product_form').serialize(),
          success: function(response) {
            // Handle the response
            //console.log(response);
            alert('Product created successfully!');
            window.location.replace('/home');
          }
        });
      }
    });
  })
</script>

@endsection