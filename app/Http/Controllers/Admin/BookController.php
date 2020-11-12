<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('admin.books.index', [
            'books' => $books,
        ]);
    }

    public function create()
    {
        $publishers = Publisher::all();
        return view('admin.books.create', [
            'publishers' => $publishers,
        ]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|max:191',
        //     'author' => 'required|max:191',
        //     'publisher' => 'required|max:191',
        //     'year' => 'required|integer|min:1900',
        //     'isbn' => 'required|alpha_num|size:13|unique:books,isbn',
        //     'price' => 'required|numeric|min:0',
        // ]);

        $book = new Book();
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->publish_date = $request->input('publish_date');
        $book->page_count = $request->input('page_count');
        $book->isbn = $request->input('isbn');
        $book->image = $request->input('image');
        $book->publisher_id = $request->input('publisher');
        $book->save();

        return redirect()->route('admin.books.index');
    }
}
