<!-- resources/views/products/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">

  @if (session()->has('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  @if (session()->has('failure'))
  <div class="alert alert-danger">
    {{ session('failure') }}
  </div>
  @endif

  <table class="table">
    <h2>Product Details</h2>

    <a href="{{ route('products.create') }}" name="create" class="btn btn-primary float-right">Add Product</a>

    <!-- Example using Blade syntax -->
    @if(Auth::check())
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <!-- <button type="submit" class="btn btn-danger float-right">Logout</button> -->
    </form>
    @endif

    <thead>
      <tr>

        <th> Name</th>
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
          {{--<form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="post">
          @csrf --}}
          <!-- @method('DELETE') -->
          <button type="submit" name="submit" class="btn btn-danger delete_btn" data-id="{{$product->id}}">Delete</button>

          <a href="{{ route('products.edit', ['id' => $product->id]) }}" name="edit" class="btn btn-primary edit_btn" data-id="{{$product->id}}">Edit</a>
          {{--</form>--}}
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script type="module">
  $(document).ready(function() {

    // Delete action
    $('.delete_btn').on('click', function() {
      var id = $(this).data('id');
      //alert(id);

      $.ajax({
        url: '/products/destroy',
        type: 'post',
        data: {
          "_token": "{{ csrf_token() }}",
          "id": id
        },
        success: function(response) {
          // Handle the response
          //console.log(response);
          alert(response);
          location.reload();
        }
      });
    })

  })
</script>
@endsection