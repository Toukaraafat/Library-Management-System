
@extends('Layouts.app')
@section('title') Create @endsection
@section('content')

<form method="POST" 
      action="{{route('posts.store')}}">
      @csrf {{--  directive la ay form by7l moshkelt l cross site request forgery  --}}
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" class="form-control" name="title"/>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea class="form-control" rows="3" name="description"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Post Creator</label>
        <select class="form-select" name="postCreator">
          @foreach($users as $user)
          <option value="{{$user->id}}">{{$user->name}}</option>
          @endforeach
        </select>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection