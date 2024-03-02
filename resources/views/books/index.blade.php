@extends('layouts.app')

@section('content')
    <h1>Books</h1>
    <a href="{{ route('books.create') }}">Create New Book</a>

    <ul>
        @foreach ($books as $book)
            <li>
                <a href="{{ route('books.show', $book->id) }}">{{ $book->name }}</a>
                <a href="{{ route('books.edit', $book->id) }}">Edit</a>
                <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection