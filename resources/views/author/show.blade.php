@extends('layouts.app')

@section('content')
    <h1>{{ $author->name }}</h1>
    <p>Number of Books: {{ $author->num_books }}</p>
    <a href="{{ route('authors.edit', $author->id) }}">Edit</a>

    <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection