<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
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
        //GET all Publishers & Categories for form
        $publishers = Publisher::all();
        $categories = Category::all();

        return view('admin.books.create', [
            'publishers' => $publishers,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:191',
            'description' => 'required|max:500',
            'publish_date' => 'required|string',
            'page_count' => 'required|biginteger|min:1900',
            'isbn' => 'required|alpha_num|size:13|unique:books,isbn',
            'image' => 'required|image|max:1999',
            'publisher_id' => 'required|integer',
        ]);

        $book = new Book();
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->publish_date = $request->input('publish_date');
        $book->page_count = $request->input('page_count');
        $book->isbn = $request->input('isbn');
        $book->publisher_id = $request->input('publisher');
        $book->save();

        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $filename = uniqid() . '.' . $ext;
        $image->storeAs('public/images', $filename);
        Storage::delete("public/images/{$user->image}");
        $user->image = $filename;

        $book->categories()->attach($request->input('categories'));

        return redirect()->route('admin.books.index');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete();

        return redirect()->route('admin.books.index');
    }
}
