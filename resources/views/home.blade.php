@extends('layouts.app')
@section('content')
<div class="container">
    <div class="p-3 bg-info bg-opacity-10 border border-info border-start-0 rounded-end">
        Category
    </div>
    <div class="row">
        @foreach($categories as $category)
            <p><a class="link-opacity-100-hover" href="{{ route('category.show', ['category' => $category->id,]) }}">{{ $category->name }}</a></p>
        @endforeach
    </div>
</div>
@endsection