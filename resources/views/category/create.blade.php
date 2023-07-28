@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Product Category</h2>
    <form id="create_category_form">
        @csrf
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" id="category_name" class="form-control" required>
        </div>
        <!-- Add any other fields you want to include in the form -->

        <button type="submit" class="btn btn-primary create_category">Add Category</button>
    </form>
</div>

<script type="module">
    $(document).ready(function() {

        // Create action for category
        $('#create_category_form').validate({
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
                    url: '/category/store',
                    type: 'post',
                    data: $('#create_category_form').serialize(),
                    success: function(response) {
                        // Handle the response
                        //console.log(response);
                        alert('Category created successfully!');
                        window.location.replace('/category');
                    }
                });
            }
        });

    })
</script>
@endsection