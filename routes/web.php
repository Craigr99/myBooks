<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/homepage', [App\Http\Controllers\HomeController::class, 'homepage'])->name('homepage');

// Routes from api
Route::post('/admin/books/search', [BookController::class, 'index'])->name('admin.books.search.index');
Route::get('/books/show/{id}/{name?}', [BookController::class, 'show'])->name('books.search.show');
Route::delete('/books/{name}', [BookController::class, 'destroy'])->name('books.destroy');

// Admin routes
Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
Route::get('/admin/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile');
Route::put('/admin', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');

Route::get('/admin/books', [App\Http\Controllers\Admin\BookController::class, 'index'])->name('admin.books.index');
Route::get('/admin/books/create', [App\Http\Controllers\Admin\BookController::class, 'create'])->name('admin.books.create');
Route::post('/admin/books', [App\Http\Controllers\Admin\BookController::class, 'store'])->name('admin.books.store');
Route::post('/admin/books/{title}', [App\Http\Controllers\Admin\BookController::class, 'add'])->name('admin.books.add');
Route::get('/admin/books/{id}', [App\Http\Controllers\Admin\BookController::class, 'show'])->name('admin.books.show');
Route::get('/admin/books/{id}/edit', [App\Http\Controllers\Admin\BookController::class, 'edit'])->name('admin.books.edit');
Route::put('/admin/books/{id}', [App\Http\Controllers\Admin\BookController::class, 'update'])->name('admin.books.update');
Route::delete('/admin/books/{id}/{name?}', [App\Http\Controllers\Admin\BookController::class, 'destroy'])->name('admin.books.destroy');

Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');

// User routes
Route::get('/user/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('user.home');
Route::get('/user/profile', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('user.profile');
Route::put('/user', [App\Http\Controllers\User\ProfileController::class, 'update'])->name('user.profile.update');

Route::get('/user/books/{name}', [App\Http\Controllers\User\BookController::class, 'index'])->name('user.books.shelf.index');
Route::post('/user/books/{id}', [App\Http\Controllers\User\BookController::class, 'store'])->name('user.books.store');
