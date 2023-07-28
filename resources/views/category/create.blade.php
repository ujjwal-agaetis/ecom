@extends('layouts.app') 

@section('content')
    <div class="container">
        <h2>Add Product Category</h2>
        <form id="create_category_form" >
            @csrf
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control" required>
            </div>
            <!-- Add any other fields you want to include in the form -->

            <button type="submit" class="btn btn-primary create_category">Add Category</button>
        </form>
    </div>
@endsection
