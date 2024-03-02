<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // ...

    public function store(Request $request)
    {
        $author = new Author();
        $author->name = $request->input('name');
        $author->save();

        return response()->json($author, 201);
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->name = $request->input('name');
        $author->num_books = $request->input('num_books', 0);
        $author->save();

        return response()->json($author, 200);
    }

    // ...

}
