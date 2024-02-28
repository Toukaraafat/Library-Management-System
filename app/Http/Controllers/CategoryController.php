<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
class CategoryController extends Controller
{
    public function index()
    {
        $categoriesFromDB = Category::all(); 

        return view('categories.crud', ['categories' => $categoriesFromDB]);
    }

    public function show(Category $category) 
    {
        return view('categories.show', ['category' => $category]);
    
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store()
    {
        
        $data = request()->all();
                // dd($data);

        $name = request()->name;
        $desc = request()->description;
        $num_books = request()->num_books;

        $category = new Category;
        $category->name = $name;
        $category->description = $desc;
        $category->num_books = $num_books;

        $category->save();

        // 3- redirection to categories.index 
        return to_route('categories.index');
    }


    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);

    }
    public function update($categoryId)
    {
        $name = request()->name;
        $desc = request()->description;
        $num_books = request()->num_books;
        // dd($num_books);
        $singleCategoryFromDB = Category::findorfail($categoryId); //select * from categories where id = $CategoryId; model object
        $singleCategoryFromDB -> update([
            "name" => $name,
            "description" => $desc,
            "num_books" => $num_books,

        ]);
        return to_route('categories.show', $categoryId);
    }
    public function destroy(Category $category)
    {
        // confirm('Are you sure you want to delete');
        $category -> delete();

        return to_route('categories.index', ['category' => $category]);

    }
}