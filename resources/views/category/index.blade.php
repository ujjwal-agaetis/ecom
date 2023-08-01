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
    <h2>Category Details</h2>

    <a href="{{ route('category.create') }}" name="create" class="btn btn-primary float-right">Add Category</a>

    <!-- Example using Blade syntax -->
    @if(Auth::check())
    <form action="{{ route('logout') }}" method="POST">
      @csrf
    </form>
    @endif

    <thead>
      <tr>
        <th>Category Name</th>

      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
      <tr>
        <td>{{ $category->name }}</td>

        <td>
          {{--<form action="{{ route('category.destroy', ['id' => $category->id]) }}" method="post">
          @csrf --}}
          
          <button type="submit" name="submit" class="btn btn-danger cat_delete_btn" data-id="{{$category->id}}">Delete</button>

          <a href="{{ route('category.edit', ['id' => $category->id]) }}" name="edit" class="btn btn-primary edit_btn" data-id="{{$category->id}}">Edit</a>
          {{--</form>--}}
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script type="module">
  $(document).ready(function() {

    // Delete action for Category
    $('.cat_delete_btn').on('click', function() {
      var id = $(this).data('id');

      $.ajax({
        url: '/category/destroy',
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