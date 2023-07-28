@extends('layouts.app') 

@section('content')
    <div class="container">
        <h2>Edit Product Category</h2>
        <form id="edit_category_form" >
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control" value="" required>
            </div>
            <!-- Add any other fields you want to include in the form -->

            <button type="submit" class="btn btn-primary edit_category ">Edit Category</button>
        </form>
    </div>
@endsection
