<?php
# @Date:   2021-01-18T10:09:12+00:00
# @Last modified time: 2021-02-01T10:14:31+00:00

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
Route::post('/admin/books/search/books', [BookController::class, 'store'])->name('admin.books.search.store');
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

Route::get('/admin/books/{id}/reviews/create', [App\Http\Controllers\Admin\ReviewController::class, 'create'])->name('admin.reviews.create');
Route::post('/admin/books/{id}/reviews/store', [App\Http\Controllers\Admin\ReviewController::class, 'store'])->name('admin.reviews.store');
Route::delete('/admin/books/{id}/reviews/{rid}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('admin.reviews.destroy');

Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');

// User routes
Route::get('/user/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('user.home');

Route::get('/user/books/{name}', [App\Http\Controllers\User\BookController::class, 'index'])->name('user.books.shelf.index');
Route::post('/user/books/{id}', [App\Http\Controllers\User\BookController::class, 'store'])->name('user.books.store');
Route::get('/user/books/{id}', [App\Http\Controllers\User\BookController::class, 'show'])->name('user.books.show');

Route::get('/user/books/{id}/reviews/create', [App\Http\Controllers\User\ReviewController::class, 'create'])->name('user.reviews.create');
Route::post('/user/books/{id}/reviews/store', [App\Http\Controllers\User\ReviewController::class, 'store'])->name('user.reviews.store');

Route::get('/user/profile/{id}', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('user.profile.index');
Route::get('/user/profile/edit/{id}', [App\Http\Controllers\User\ProfileController::class, 'edit'])->name('user.profile.edit');
Route::put('/user', [App\Http\Controllers\User\ProfileController::class, 'update'])->name('user.profile.update');
Route::post('/user/profile/{id}/follow', [App\Http\Controllers\User\FollowsController::class, 'store'])->name('user.profile.store'); // follow a user

Route::get('/user/{id}/blogs', [App\Http\Controllers\User\BlogController::class, 'index'])->name('user.blogs.index');
Route::get('/user/blogs/create', [App\Http\Controllers\User\BlogController::class, 'create'])->name('user.blogs.create');
Route::get('/user/blogs/{id}', [App\Http\Controllers\User\BlogController::class, 'show'])->name('user.blogs.show');
Route::post('/user/blogs/store', [App\Http\Controllers\User\BlogController::class, 'store'])->name('user.blogs.store');
Route::get('/user/reviews/{id}', [App\Http\Controllers\User\ReviewController::class, 'show'])->name('user.reviews.show');

Route::get('/{category}/books', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.books.index');
