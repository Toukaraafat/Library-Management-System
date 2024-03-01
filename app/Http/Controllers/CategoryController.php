<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

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
        $categoriesFromDB = $query->get();

        return view('categories.crud', ['categories' => $categoriesFromDB]);
    }
    $categoriesFromDB = $query->get();

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

    public function store(Request $request)
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
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:20',
            'description' => 'required|min:8',
            'num_books' => 'required|max:255|integer'
        ]);


        $category->save();

        // 3- redirection to categories.index
        return to_route('categories.index');
    }


    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }
    public function update(Request $request, $categoryId)
    {
        $name = request()->name;
        $desc = request()->description;
        $num_books = request()->num_books;
        $validated = $request->validate([
            'name' => 'required|unique:categories,name,' . $categoryId . ',id|max:20',
            'description' => 'required|min:8',
            'num_books' => 'required|integer'
        ]);
        // dd($num_books);
        $singleCategoryFromDB = Category::findorfail($categoryId); //select * from categories where id = $CategoryId; model object
        $singleCategoryFromDB->update([
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
