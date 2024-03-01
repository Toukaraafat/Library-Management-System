
@extends('Layouts.app')
@section('title') Create @endsection
@section('content')

<form method="POST"
      action="{{route('categories.store')}}">
      @csrf {{--  directive la ay form by7l moshkelt l cross site request forgery  --}}
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" class="form-control" name="name"/>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea class="form-control" rows="3" name="description"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Number of books</label>
      <input type="text" class="form-control" name="num_books"/>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

 @if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif
@endsection


