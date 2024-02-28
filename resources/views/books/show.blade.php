
@extends('Layouts.app')
@section('title') Post @endsection
@section('content')
        <div class="card mt-4">
            <div class="card-header">
              Post info
            </div>
            <div class="card-body">
              <h5 class="card-title">Title: {{$post->title}}</h5>
              <p class="card-text">Description: {{$post->description}}</p>
            </div>
          </div>
          <div class="card mt-4">
            <div class="card-header">
                Post Creator Info
            </div>
            <div class="card-body">
              <h5 class="card-title">Name: Touka</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
          </div>
@endsection