@extends('Layouts.app')
@section('title') categories @endsection
@section('content')
<div class="container row ">
    <div class="text-center col-3 mt-4">
        <a href="{{route('categories.create')}}" class="btn btn-primary">Create category</a>
    </div>
    <div class="text-center col-4  mt-4">

        <form class="" id="sortForm" action="{{ route('categories.index') }}" method="GET">
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

        <form class=" " id="searchForm" action="{{ route('categories.index') }}" method="GET">
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
            <th scope="col">No.of books</th>
            {{-- <th scope="col">Created At</th> --}}
            <th scope="col">Actions</th>

        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <th scope="row">{{$category->id}}</th>
            <td>{{$category->name}}</td>
            <td>{{$category->description}}</td>
            <td>{{$category->num_books}}</td>
            {{-- <td>{{$category['created_at']}}</td> --}}
            <td>
                <a href="{{route('categories.show', $category['id'])}}" class="btn btn-info">View</a>
                <a href="{{route('categories.edit' , $category['id'])}}" class="btn btn-primary">Edit</a>
                <form class="d-inline" method="post" action="{{route('categories.destroy' , $category['id'])}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete

                    </button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
<script>
    document.getElementById('sort').addEventListener('change', function() {
        console.log("hello");
        document.getElementById('sortForm').submit();
    });
</script>
<script>
    document.getElementById('search').addEventListener('blur', function() {
        console.log("hello");
        document.getElementById('searchForm').submit();
    });
</script>


@endsection
