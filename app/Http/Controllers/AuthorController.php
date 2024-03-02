<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
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
            'name' => 'required|string|max:20',
            'num_books' => 'required|integer',
        ]);

        $author = Author::create($validatedData);

        return redirect()->route('authors.index');
    }

    public function show($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.show', compact('author'));
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:20',
            'num_books' => 'required|integer',
        ]);

        $author = Author::findOrFail($id);
        $author->update($validatedData);

        return redirect()->route('authors.index');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.index');
    }
}
