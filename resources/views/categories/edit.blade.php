
@extends('Layouts.app')
@section('title') Edit @endsection
@section('content')

<form method="POST" 
action="{{route('categories.update', $category['id'])}}">
      @csrf 
      @method('PUT')
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" class="form-control" name="name" value="{{$category->name}}"/>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea class="form-control" rows="3" name="description" >{{$category->description}}</textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Number of books</label>
      <input type="text" class="form-control" name="num_books" value="{{$category->num_books}}"/>

      </div>

    <button type="submit" class="btn btn-warning">Update</button>
  </form>
@endsection