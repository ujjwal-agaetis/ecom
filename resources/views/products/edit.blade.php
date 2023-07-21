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
            <option value="active"{{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive"{{ $product->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

    </div>

    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" class="form-control" name="quantity" id="quantity" value="{{$product->quantity}}">

    </div>

    <div class="form-group">
        <label for="stock">Availability:</label>
        <select name="stock" class="form-control" id="stock">
            <option value="in-stock"{{ $product->stock === 'in-stock' ? 'selected' : '' }}>In Stock</option>
            <option value="sold-out"{{ $product->stock === 'sold-out' ? 'selected' : '' }}>Sold Out</option>
        </select>

    </div>
</br>

<button type="submit" name="submit" class="btn btn-primary edit_product">Edit</button>

</form>

</div>
@endsection