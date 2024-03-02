@extends('layouts.app')

@section('content')
    <h1>Create New Book</h1>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="author_id">Author:</label>
        <select name="author_id" required>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}">{{ $author->name }}</option>
            @endforeach
        </select>

        <label for="image">Image URL:</label>
        <input type="url" name="image" required>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>

        <label for="categories">Categories:</label>
        <select name="categories[]" multiple required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit">Create Book</button>
    </form>
@endsection
