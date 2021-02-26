<?php

use App\Http\Controllers\API\BookController as APIBookController;
use App\Http\Controllers\API\PublisherController as APIPublisherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route group using api middleware
Route::middleware('api')->group(function () {
    //GET all books
    Route::get('/books', [APIBookController::class, 'index']);
    //GET book by id
    Route::get('/books/{id}', [APIBookController::class, 'show']);
    //Store a book
    Route::post('/books', [APIBookController::class, 'store']);
    // Update book
    Route::put('/books/{id}', [APIBookController::class, 'update']);
    // Delete a book
    Route::delete('/books/{id}', [APIBookController::class, 'destroy']);

    //GET all publishers
    Route::get('/publishers', [APIPublisherController::class, 'index']);
});
