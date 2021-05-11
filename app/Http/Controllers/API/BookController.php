<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all()->load('publisher', 'reviews.user');

        // Return response with data as JSON, and 200 status code
        return response()->json([
            'status' => 'success',
            'data' => $books,
        ], 200);
    }
    public function search(Request $request, $term)
    {
        $books = Book::where('title', 'like', "%{$term}%")
            ->orWhere('description', 'like', "%{$term}%")
            ->orWhere('publish_date', 'like', "%{$term}%")
            ->orWhere('isbn', 'like', "%{$term}%")
            ->orWhere('page_count', 'like', "%{$term}%")
            ->get();

        // Return response with data as JSON, and 200 status code
        return response()->json([
            'status' => 'success',
            'data' => $books,
        ], 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:191',
            'authors' => 'required',
            'description' => 'required|max:500',
            'publish_date' => 'required|string',
            'page_count' => 'required|min:1',
            'isbn' => 'required|alpha_num|size:13|unique:books,isbn',
            // 'image' => 'required|max:1999',
            'publisher_id' => 'required|integer',
            'categories' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $book = new Book();

        // if ($request->hasFile('cover')) {
        //     $cover = $request->file('cover');
        //     $extension = $cover->getClientOriginalExtension();
        //     $filename = date('Y-m-d-His') . '_' . $request->input('isbn') . '.' . $extension;
        //     $path = $cover->storeAs('public/covers', $filename);

        //     $book->cover = $filename;
        // }

        $book->id = Str::random(10);
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->publish_date = $request->input('publish_date');
        $book->page_count = $request->input('page_count');
        $book->isbn = $request->input('isbn');
        $book->publisher_id = $request->input('publisher_id');
        $book->image = "https://picsum.photos/200/300";
        $book->save();

        $book->categories()->attach($request->input('categories'));
        $book->authors()->attach($request->input('authors'));

        return response()->json([
            'status' => 'success',
            'data' => $book,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);

        if ($book === null) {
            $statusMsg = "Book not found";
            $statusCode = 404;

        } else {
            $book->load('publisher', 'authors', 'reviews');
            $statusMsg = "success";
            $statusCode = 200;
        }

        return response()->json([
            'status' => $statusMsg,
            'data' => $book,
        ], $statusCode);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $book = Book::find($id);

    //     if ($book === null) {
    //         return response()->json([
    //             'status' => 'Book not found',
    //             'data' => null,
    //         ], 404);
    //     }

    //     $rules = [
    //         'title' => 'required|max:191',
    //         'author' => 'required|max:191',
    //         'publisher_id' => 'required|integer|exists:publishers,id',
    //         'cover' => 'file|image',
    //         'year' => 'required|integer|min:1900',
    //         'isbn' => 'required|alpha_num|size:13|unique:books,isbn,' . $book->id,
    //         'price' => 'required|numeric|min:0',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     $book->title = $request->input('title');
    //     $book->author = $request->input('author');
    //     $book->publisher_id = $request->input('publisher_id');
    //     $book->year = $request->input('year');
    //     $book->isbn = $request->input('isbn');
    //     $book->price = $request->input('price');
    //     $book->save();

    //     return response()->json([
    //         'status' => 'success',
    //         'data' => $book->load('publisher'),
    //     ], 200);
    // }

    public function destroy($id)
    {
        $book = Book::find($id);

        if ($book === null) {
            $statusMsg = "Book not found";
            $statusCode = 404;

        } else {
            $book->delete();
            $statusMsg = "deleted successfully";
            $statusCode = 200;
        }

        return response()->json([
            'status' => $statusMsg,
            'data' => null,
        ], $statusCode);
    }
}
