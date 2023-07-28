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

    <a href="{{ route('category.create') }}" name="create" class="btn btn-primary float-right">Add Product</a>

    <!-- Example using Blade syntax -->
    @if(Auth::check())
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <!-- <button type="submit" class="btn btn-danger float-right">Logout</button> -->
    </form>
    @endif

    <thead>
      <tr>

        <th>Category Name</th>
        

      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{ $product->name }}</td>
        
        <td>
          {{--<form action="{{ route('category.destroy', ['id' => $category->id]) }}" method="post">
            @csrf --}}
            <!-- @method('DELETE') -->
            <button type="submit" name="submit" class="btn btn-danger delete_btn" data-id="{{$category->id}}">Delete</button>

            <a href="{{ route('category.edit', ['id' => $category->id]) }}" name="edit" class="btn btn-primary edit_btn" data-id="{{$category->id}}">Edit</a>
          {{--</form>--}}
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection