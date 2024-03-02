@extends('layouts.app')

@section('content')
    <h1>Edit Author - {{ $author->name }}</h1>

    <form action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $author->name }}" required>

        <label for="num_books">Number of Books:</label>
        <input type="number" name="num_books" value="{{ $author->num_books }}" required>

        <button type="submit">Update Author</button>
    </form>
@endsection