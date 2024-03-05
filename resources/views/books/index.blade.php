@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Books</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add Book</a>
    <div class="text-center col-4  mt-4">

        <form class="" id="sortForm" action="{{ route('books.index') }}" method="GET">
            <!-- <label>sort by :</label> -->
            <select class="form-control" name="sort" id="sort">
            <option value="" selected>sort by:default</option>
                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>latest</option>
                <!-- Add more options as needed -->

            </select>
        </form>

    </div>
    <div class="text-center col-5  mt-4">

        <form class=" " id="searchForm" action="{{ route('books.index') }}" method="GET">
            <input id="search" class="form-control " type="text" placeholder="search by name" name="search" value="{{ request('search') }}">
        </form>
    </div>

  
   






     <label for="category">Filter by Category:</label>
     <form class="" id="filterForm" action="{{ route('books.index') }}" method="GET">

    <select name="category" id="category">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category->name }}" {{ request('category') == $category->name ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select> 
    </form>



    <div class="row">





        @foreach($books as $book)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <img class="card-img-top" src="{{ url('dist/img/products/' . $book->image)}}">
                <div class="card-body">
                    <h4 class="card-title">{{ $book->name }}</h4>
                    <p class="card-text">{{ $book->description }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    document.getElementById('sort').addEventListener('change', function() {
        console.log("hello");
        document.getElementById('sortForm').submit();
    });
</script>
<script>
    document.getElementById('category').addEventListener('change', function() {
        console.log("hello");
        document.getElementById('filterForm').submit();
    });
</script>
<script>
    document.getElementById('search').addEventListener('blur', function() {
        console.log("hello");
        document.getElementById('searchForm').submit();
    });
</script>
@endsection
