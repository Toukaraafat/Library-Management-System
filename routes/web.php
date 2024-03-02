<?php


use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

/*
|--------------------------------------------------------------------------
larvel design pattern -> mvc model view controller
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/books', [BookController::class, 'index'])->name('books.index');


Route::get('/books/create', [BookController::class, 'create'])->name('books.create');


Route::post('/books', [BookController::class, 'store'])->name('books.store');


Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');


Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');


Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');


Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');




Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');


Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');

Route::post('/auhors', [AuthorController::class, 'store'])->name('authors.store');


Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');


Route::get('/authors/{author}/edit', [AuthorController::class, 'edit'])->name('authors.edit');


Route::put('/authors/{author}', [AuthorController::class, 'update'])->name('authors.update');


Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');

Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/categories/{category}'/*url dynamic parameter */ , [CategoryController::class, 'show'])->name('categories.show');

Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

