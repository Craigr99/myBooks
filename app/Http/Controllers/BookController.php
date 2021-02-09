<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => $request->input('title'),
            'maxResults' => 12,
        ]);

        if (isset($response->json()['items'])) {

            return view('books.index', [
                'data' => $response->json()['items'],
            ]);

        } else {
            return view('books.index', [
                'data' => null,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null, $name = null)
    {
        $book = Book::find($id);

        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'volumeId' => $id,
            'q' => $name,
        ]);

        // If the book is from an API search
        if (isset($response->json()['items'][0])) {
            return view('books.show', [
                'item' => $response->json()['items'][0],
            ]);
        } else {
            // Return view for books from local database
            return view('user.books.show', [
                'book' => $book,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $name)
    {
        $book = Book::where('title', $name)->first();
        $book->delete();
        $request->session()->flash('danger', 'Book removed successfully!');

        return redirect()->route('admin.books.index');
    }

}
