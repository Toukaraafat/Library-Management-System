@extends('Layouts.app')
@section('title') books @endsection
@section('content')
@if(auth()->guest())
    {{-- If the user is a guest (not logged in), redirect to the login page --}}
    <script>window.location.href = "{{ route('login') }}";</script>
@endif

<div class="container row ">
    <div class="text-center col-3 mt-4">
        <a href="{{route('books.create')}}" class="btn btn-primary">Create book</a>
    </div>
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

</div>
{{-- @dd($categories)//die dump --}}
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            {{-- <th scope="col">Created At</th> --}}
            <th scope="col">Actions</th>
            <th scope="col">image</th>


        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <th scope="row">{{$book->id}}</th>
            <td>{{$book->name}}</td>
            <td>{{$book->description}}</td>
            {{-- <td>{{$category['created_at']}}</td> --}}
            <td>
                <a href="{{route('books.show', $book['id'])}}" class="btn btn-info">View</a>
                <a href="{{route('books.edit' , $book['id'])}}" class="btn btn-primary">Edit</a>
                <form class="d-inline" method="post" action="{{route('books.destroy' , $book['id'])}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete

                    </button>
                </form>
            </td>
        <td>
            <img src="{{url('dist/img/products/'.$book->image)}}" width="100" height="100">

        </td>
        </tr>
        @endforeach

    </tbody>
</table>
<script>
    document.getElementById('sort').addEventListener('change', function() {
        document.getElementById('sortForm').submit();
    });
</script>
<script>
    document.getElementById('search').addEventListener('blur', function() {
        document.getElementById('searchForm').submit();
    });
</script>


@endsection
