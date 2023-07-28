@extends('layouts.app') <!-- Assuming you have a layout file with the name "app.blade.php" -->

@section('content')
    <div class="container">
        <h2>Add Product Category</h2>
        <form action="{{ route('category.create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <!-- Add any other fields you want to include in the form -->

            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
@endsection
