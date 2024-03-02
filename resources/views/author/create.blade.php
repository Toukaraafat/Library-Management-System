@extends('layouts.app')

@section('content')
    <h1>Create New Author</h1>

    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="num_books">Number of Books:</label>
        <input type="number" name="num_books" required>

        <button type="submit">Create Author</button>
    </form>
@endsection