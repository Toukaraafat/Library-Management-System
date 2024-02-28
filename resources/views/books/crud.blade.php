@extends('Layouts.app')
@section('title') categories @endsection
@section('content')
        <div class="text-center mt-4">
            <a href="{{route('categories.create')}}" class="btn btn-success">Create Category</a>
        </div>
        {{-- @dd($categories)//die dump --}}
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">No.of books</th>
                {{-- <th scope="col">Created At</th> --}}
                <th scope="col">Actions</th>

              </tr>
            </thead>
            <tbody>
                @foreach($categories as $Category)
              <tr>
                <th scope="row">{{$Category->id}}</th>
                <td>{{$Category->name}}</td>
                <td>{{$Category->description}}</td>
                <td>{{$Category->num_books}}</td>
                {{-- <td>{{$Category['created_at']}}</td> --}}
                <td>
                    <a href="{{route('categories.show', $Category['id'])}}" class="btn btn-info">View</a>
                    <a href="{{route('categories.edit' , $Category['id'])}}" class="btn btn-primary">Edit</a>
                    <form class="d-inline" method="Category" action="{{route('categories.destroy' , $Category['id'])}}">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger">Delete

                      </button>
                    </form>
                    </td>
              </tr>
    @endforeach
       
            </tbody>
          </table>
@endsection