<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    
  </head>
  <body>
    <div class="container">
        
<h1>Edit Product</h1>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    <!-- @method('PUT') -->

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


<button type="submit" name="submit" class="btn btn-primary">Edit</button>

</form>

</div>
</button>
</form>
</div>
</body>