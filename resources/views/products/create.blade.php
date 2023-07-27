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


  <form id="create_product_form">
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
      <input type="number" class="form-control" name="quantity" id="quantity" value="">

    </div>

    <div class="form-group">
      <label for="category_id">Category:</label>
      <select name="category_id" class="form-control" id="category_id">
        <option value="">Select Category</option>  
      @foreach($categories as $cat)
        <option value="{{$cat->id}}">{{$cat->categories_name}}</option>
        
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
</br>

    <button type="submit" name="submit" class="btn btn-primary create_product">Create</button>

  </form>

</div>
@endsection