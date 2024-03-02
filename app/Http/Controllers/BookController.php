<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Category;
class BookController extends Controller
{

    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('books.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'author_id' => 'required|exists:authors,id',
            'image' => 'required|image|max:15',
            'description' => 'required',
            'categories' => 'required|array',
        ]);

        $book = Book::create($validatedData);
        $book->categories()->attach($request->input('categories'));

        return redirect()->route('books.index');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = Author::all();
        $categories = Category::all();

        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'author_id' => 'required|exists:authors,id',
            'image' => 'required|image|max:15',
            'description' => 'required',
            'categories' => 'required|array',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validatedData);
        $book->categories()->sync($request->input('categories'));

        return redirect()->route('books.index');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->categories()->detach();
        $book->delete();

        return redirect()->route('books.index');
    }
}
