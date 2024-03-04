
@extends('Layouts.app')
@section('title') Create @endsection
@section('content')

<form
      action="{{route('books.store')}}" method="post" enctype="multipart/form-data">
      @csrf {{--  directive la ay form by7l moshkelt l cross site request forgery  --}}
    <div class="mb-3">
      <label class="form-label">name</label>
      <input type="text" class="form-control" name="name"/>
    </div>
    <div class="mb-3">
      <label class="form-label">author name</label>
      <input type="text" class="form-control" name="author"/>
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea class="form-control" rows="3" name="description"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">upload your image</label>
      <input type="file"  class="form-control" name="image" >
    </div>
    <select class="form-select" aria-label="Default select example" name="category">
  <option selected>select category</option>
  <option value="cat 1">cat1</option>
  <option value="cat 2">cat2</option>
  <option value="cat3">cat3</option>

    </select>

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



