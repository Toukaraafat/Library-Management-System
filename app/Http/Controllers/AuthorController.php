<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:20',
        ]);
        $author = new Author();
        $author->name = $validatedData['name'];
        $author->num_books = $request->num_books;
        $author->save();
 
        return redirect()->route('authors.index');
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        $author->name = $request->name;
        $author->num_books = $request->num_books;
        $author->save();

        return redirect()->route('authors.index');
    }

    public function destroy($id)
    {
        $author = Author::find($id);
        $author->delete();

        return redirect()->route('authors.index');
    }
}
