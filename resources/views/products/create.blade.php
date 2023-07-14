<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    
  </head>
  <body>
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


    <!-- <h2 class="text-center">Products</h2> -->

    <form action="{{ route('products.store') }}" method="post">
        @csrf

<div class="form-group">
    <label for="">Name</label>
    <input type="text" class="form-control" name="name" value="" id="name"  placeholder="">
  </div>

  <div class="form-group">
    <label for="slug">Slug</label>
    <input type="slug" class="form-control" id="slug" value=""  name="slug" placeholder="">
  </div>

  <div class="form-group">
  <label for="description">Description:</label>
        <textarea name="description" class="form-control" id="description" ></textarea>
 </div>
 
 <div class="form-group">
 <label for="status">Status:</label>
        <select name="status" class="form-control" id="status" >
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>

 </div>
    
 <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number"  class="form-control" name="quantity" id="quantity" value="" >

</div>

        <button type="submit" name="submit" class="btn btn-primary">Create</button>

 </form>

</div>
  
  </body>
</html>

