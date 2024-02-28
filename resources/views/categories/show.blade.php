
@extends('Layouts.app')
@section('title') Category @endsection
@section('content')
        <div class="card mt-4">
            <div class="card-header">
              Category info
            </div>
            <div class="card-body">
              <h5 class="card-title">Title: {{$category['name']}}</h5>
              <h6 class="card-title">Numbers of books: {{$category['num_books']}}</h6>
              <p class="card-text">Description: {{$category->description}}</p>
            </div>
          </div>
    
@endsection