<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::query();
        $categories = Category::all();

        $search = $request->input('search');
        if ($search) {
            $books->where('name', 'LIKE', "%$search%");

        }

        // Sorting
        $sort = $request->input('sort');

        if ($sort=="name") {
            $books->orderBy($sort);
        }
        if ($sort=="created_at") {
            $books->orderByDesc($sort);

        }
        $categoryFilter = $request->input('category');
        if ($categoryFilter && $categoryFilter !== 'All Categories') {


            $books = Book::where('category', $categoryFilter);
        }
            // ($selectedCategory) {
            //     $books->where('category', $selectedCategory);
            // }} 

            
        

        else {
            $books = $books->get();

            return view('books.index', ['books' => $books,'categories'=>$categories]);
        }
        $books = $books->get();
        return view('books.index', ['books' => $books,'categories'=>$categories]);

    }
    

    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('books.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'author_id' => 'required|exists:authors,id',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:15360',
        ]);
    
        // Handle the case when no categories are selected
        
        $imageFileName = now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('/dist/img/products'), $imageFileName);
        // Create a new book instance
        $book = new Book();
        $book->name = $validatedData['name'];
        $book->author_id = $validatedData['author_id'];
        $book->description = $validatedData['description'];
        $book->image = $imageFileName ; 
        $book->category = $validatedData['category'];
 
        $book->save();
    
        // Attach categories to the book
    
        return redirect()->route('books.index');
    }

    public function edit($id)
    {
        $authors = Author::all();
        $categories = Category::all();
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    public function update(Request $request, $id)
    {
        // Find the book by ID
        $book = Book::findOrFail($id);
    
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'description' => 'required|string',
            'categories' => 'required|array',
            'image' => 'nullable|image|max:2048', // Allow image to be nullable for updating without changing the image
        ]);
    
        // Update the book attributes
        $book->name = $validatedData['name'];
        $book->author_id = $validatedData['author_id'];
        $book->description = $validatedData['description'];
    
        // Check if a new image is provided
        if ($request->hasFile('image')) {
            // Store the new image and update the image attribute
            $book->image = $request->file('image')->store('books');
        }
    
        // Sync categories
        $book->categories()->sync($validatedData['categories']);
    
        // Save the updated book
        $book->save();
    
        // Redirect to the index page
        return redirect()->route('books.index');
    }
    
    public function destroy($id)
    {   $book = Book::find($id);
        $book->delete();

        return redirect()->route('books.index');
    }
}
