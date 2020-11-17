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
            'page_count' => 'required|min:1',
            'isbn' => 'required|alpha_num|size:13|unique:books,isbn',
            'image' => 'required|string|max:1999',
            'publisher_id' => 'required|integer',
            'categories' => 'required',
        ]);

        $book = new Book();
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->publish_date = $request->input('publish_date');
        $book->page_count = $request->input('page_count');
        $book->isbn = $request->input('isbn');
        $book->image = $request->input('image');
        $book->publisher_id = $request->input('publisher_id');
        $book->save();

        // $image = $request->image;
        // $ext = $image->getClientOriginalExtension();
        // $filename = uniqid() . '.' . $ext;
        // $image->storeAs('public/images', $filename);
        // Storage::delete("public/images/{$user->image}");
        // $user->image = $filename;

        $book->categories()->attach($request->input('categories'));

        return redirect()->route('admin.books.index');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete();

        return redirect()->route('admin.books.index');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('admin.books.show', [
            'book' => $book,
        ]);
    }

    public function edit($id)
    {
        $publishers = Publisher::all();
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('admin.books.edit', [
            'book' => $book,
            'publishers' => $publishers,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:191',
            'author' => 'required|max:191',
            'publisher_id' => 'required',
            'year' => 'required|integer|min:1900',
            'isbn' => 'required|alpha_num|size:13|unique:books,isbn,' . $id,
            'price' => 'required|numeric|min:0',
        ]);

        $book = Book::findOrFail($id);
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publisher_id = $request->input('publisher_id');
        $book->year = $request->input('year');
        $book->isbn = $request->input('isbn');
        $book->price = $request->input('price');
        $book->save();

        return redirect()->route('admin.books.index');
    }
}
