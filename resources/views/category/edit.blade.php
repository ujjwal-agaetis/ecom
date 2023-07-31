@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product Category</h2>
    <form id="edit_category_form">
        @csrf
        <div class="form-group">
            <input type="hidden" name="id" value="{{$category->id}}">
            <label for="name">Category Name</label>
            <input type="text" name="category_name" id="category_name" class="form-control" value="{{$category->category_name}}" required>
        </div>
        <!-- Add any other fields you want to include in the form -->

        <button type="submit" class="btn btn-primary edit_category ">Edit Category</button>
    </form>
</div>
<script type="module">
    $(document).ready(function() {
        
        // Edit action for category
        $('#edit_category_form').validate({
            rules: {
                category_name: {
                    required: true,

                },

                // Add more rules for other form fields as needed
            },
            messages: {
                category_name: {
                    required: "Please enter Category name",

                },

                // Add more custom error messages for other form fields
            },
            submitHandler: function(form) {
                $.ajax({
                    url: '/category/update',
                    type: 'post',
                    data: $('#edit_category_form').serialize(),
                    success: function(response) {
                        // Handle the response
                        //console.log(response);
                        alert('Category updated successfully!');
                        window.location.replace('/category');
                    }
                });
            }
        });

    })
</script>
@endsection