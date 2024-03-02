<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author', 'categories')->get();
        return response()->json($books, 200);
    }

    public function store(Request $request)
    {
        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    public function show($id)
    {
        $book = Book::with('author', 'categories')->findOrFail($id);
        return response()->json($book, 200);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return response()->json(null, 204);
    }
    public function listBooks(Request $request)
    {
        $query = Book::with('author', 'categories');

        // Order by
        if ($request->has('order_by')) {
            $orderField = $request->input('order_by');
            $query->orderBy($orderField, 'asc');
        }

        // Search by title
        if ($request->has('title')) {
            $title = $request->input('title');
            $query->where('name', 'like', "%$title%");
        }

        // Search by author
        if ($request->has('author')) {
            $author = $request->input('author');
            $query->whereHas('author', function ($query) use ($author) {
                $query->where('name', 'like', "%$author%");
            });
        }

        // Filter by category
        if ($request->has('category')) {
            $category = $request->input('category');
            $query->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            });
        }

        $books = $query->get();
        return response()->json($books, 200);
    }

}
