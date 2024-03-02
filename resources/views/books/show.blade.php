@extends('layouts.app')

@section('content')
    <h1>{{ $book->name }}</h1>
    <p>Author: {{ $book->author->name }}</p>
    <p>Image: <img src="{{ $book->image }}" alt="{{ $book->name }} Image"></p>
    <p>Description: {{ $book->description }}</p>
    <p>Categories:
        @foreach ($book->categories as $category)
            {{ $category->name }},
        @endforeach
    </p>
    <a href="{{ route('books.edit', $book->id) }}">Edit</a>

    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection