<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
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
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
Route::get('/admin/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile');
Route::put('/admin', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
Route::get('/admin/books', [App\Http\Controllers\Admin\BookController::class, 'index'])->name('admin.books.index');
Route::get('/admin/books/create', [App\Http\Controllers\Admin\BookController::class, 'create'])->name('admin.books.create');

Route::get('/user/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('user.home');
