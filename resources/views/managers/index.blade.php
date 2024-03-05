@extends('layouts.app')
@section('content')
<div class="container">
        <h1>managers main page</h1>
        @if ($managers->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($managers as $manager)
                        <tr>
                            <td>{{ $manager->id }}</td>
                            <td>{{ $manager->name }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('managers.edit', ['id' => $manager->id]) }}" class="btn btn-primary">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('managers.destroy', $manager->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No managers found.</p>
        @endif

        <a href="{{ route('managers.create') }}" class="btn btn-primary">Add manager</a>
    </div>
@endSection