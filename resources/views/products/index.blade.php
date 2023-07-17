<!-- resources/views/products/index.blade.php -->


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Ecommerce</title>
  </head>
  <body>

  <div class="container">
 
  <table class="table">
    <h2>Product Details</h2>
    
  <a href="{{ route('products.create') }}" name="create" class="btn btn-primary float-right">Add Product</a>

  <thead>
    <tr>
    
               <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>Availability</th>
                <th>Action</th>

    </tr>
  </thead>
  <tbody>
  @foreach($products as $product)
    <tr>
                   <td>{{ $product->name }}</td>
                    <td>{{ $product->slug }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
	<form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="post">
		@csrf
    <!-- @method('DELETE') -->
		<button type="submit" name="submit" class="btn btn-danger">Delete</button>

    <a href="{{ route('products.edit', ['id' => $product->id]) }}" name="edit" class="btn btn-primary">Edit</a>
</form>
</td>

</tr>
    @endforeach
  </tbody>
</table>
</div>
    
</body>
</html>

