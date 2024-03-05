<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\SuperadminMiddleware;
use App\Http\Middleware\Admin;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');


Auth::routes();



Route::middleware([Admin::class])->group(function () {
    Route::group(['prefix' => 'authors', 'controller' => AuthorController::class, 'as' => 'authors.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        // Route::get('/edit/{id}', 'edit')->name('edit');
        // Route::put('/update/{id}', 'update')->name('update');
        // Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });
});
Route::middleware([Admin::class])->group(function () {

    Route::group(['prefix' => 'books', 'controller' => BookController::class, 'as' => 'books.'], function () {
        Route::get('/', 'index')->name('index')->withoutMiddleware(Admin::class);
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });
});

    Route::middleware([Admin::class])->group(function () {

    Route::group(['prefix' => 'categories', 'controller' => CategoryController::class, 'as' => 'categories.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });
});


Route::get('/admin/users/make-admin', [AdminController::class, 'makeUserAdmin'])->name('admin.users.makeAdmin');




// Route group for managers with middleware to restrict access to super admins
Route::middleware([SuperadminMiddleware::class])->group(function () {
    Route::group(['prefix' => 'managers', 'controller' => ManagerController::class, 'as' => 'managers.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });
});
