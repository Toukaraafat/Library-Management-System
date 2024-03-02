@extends('layouts.app')

@section('content')
    <h1>Edit Book - {{ $book->name }}</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $book->name }}" required>

        <label for="author_id">Author:</label>
        <select name="author_id" required>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}" @if($book->author_id == $author->id) selected @endif>{{ $author->name }}</option>
            @endforeach
        </select>

        <label for="image">Image URL:</label>
        <input type="url" name="image" value="{{ $book->image }}" required>

        <label for="description">Description:</label>
        <textarea name="description" required>{{ $book->description }}</textarea>

        <label for="categories">Categories:</label>
        <select name="categories[]" multiple required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if(in_array($category->id, $book->categories->pluck('id')->toArray())) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit">Update Book</button>
    </form>
@endsection