@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ isset($category) ? 'Edit Category' : 'Create Category' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('categories.update', ['id' => $category->id]) }}">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ isset($category) ? $category->name : '' }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ isset($category) ? $category->description : '' }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Create' }}</button>
                    </>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
