<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Category;
class BookController extends Controller
{

    public function index(request $request)
    {

        $query = Book::query();

        // Searching
        $search = $request->input('search');
        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }

        // Sorting
        $sort = $request->input('sort');

        if ($sort=="name") {
            $query->orderBy($sort);
        }
        if ($sort=="created_at") {
            $query->orderByDesc($sort);
        }
        else {
        $booksdromdb = $query->get();

        return view('books.index', ['books' => $booksdromdb]);
    }
    $booksdromdb = $query->get();

    return view('books.index', ['books' => $booksdromdb]);
}













    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('books.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {

        $name = request()->name;
        $author=$request->author;
        $desc = request()->description;
        $category = $request->category;
        // Move the uploaded file to the desired directory
        $imageFileName = now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('/dist/img/products'), $imageFileName);

        $book = new Book;
        $book->name = $name;
        $book->description = $desc;
        $book->image = $imageFileName;
        $book->category=$category;
        $book->author = $author;

        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'author' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);


        $book->save();


        return to_route('books.index');
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
