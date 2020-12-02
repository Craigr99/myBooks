<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use DB;
use Http;
use Illuminate\Http\Request;
use Storage;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

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
        $categories = Category::all();
        $books = Book::all();
        $authors = Author::all();

        return view('admin.books.create', [
            'publishers' => $publishers,
            'categories' => $categories,
            'books' => $books,
            'authors' => $authors,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:191',
            'authors' => 'required',
            'description' => 'required|max:500',
            'publish_date' => 'required|string',
            'page_count' => 'required|min:1',
            'isbn' => 'required|alpha_num|size:13|unique:books,isbn',
            'image' => 'required|max:1999',
            'publisher_id' => 'required|integer',
            'categories' => 'required',
        ]);

        $book = new Book();
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->publish_date = $request->input('publish_date');
        $book->page_count = $request->input('page_count');
        $book->isbn = $request->input('isbn');
        $book->publisher_id = $request->input('publisher_id');

        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $filename = uniqid() . '.' . $ext;
        $image->storeAs('public/images', $filename);
        Storage::delete("public/images/{$book->image}");
        $book->image = $filename;

        $book->save();

        $book->categories()->attach($request->input('categories'));
        $book->authors()->attach($request->input('authors'));

        return redirect()->route('admin.books.index');
    }

    //
    // Add book to databse from admin searching a book using the API
    //
    public function add($title)
    {
        // Get the book from response
        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => $title,
        ]);

        // Set variables
        // dd($response->json()['items'][0]);
        $book = $response->json()['items'][0]['volumeInfo'];
        $title = $book['title'];
        $publish_date = $book['publishedDate'];
        isset($book['description']) ? $description = $book['description'] : $description = 'Not found';
        $publisher = $book['publisher'];
        $image = $book['imageLinks']['thumbnail'];
        $page_count = $book['pageCount'];
        $authors = $book['authors'];
        $categories = $book['categories'];

        // Insert new or update Publisher in publishers table
        DB::table('publishers')->updateOrInsert([
            'name' => $publisher,
        ]);
        $publisher = Publisher::where('name', $publisher)->first();

        // Insert new or update Book in books table
        DB::table('books')->updateOrInsert([
            'title' => $title,
            'description' => $description,
            'publish_date' => $publish_date,
            'page_count' => $page_count,
            'image' => $image,
            'publisher_id' => $publisher->id,
        ]);

        // Insert new category if it does not exist, and insert book category row in DB
        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert([
                'name' => $category,
            ]);

            $book = Book::where('title', $title)->first();
            $category = Category::where('name', $category)->first();

            DB::table('book_category')->updateOrInsert([
                'book_id' => $book->id,
                'category_id' => $category->id,
            ]);
        }

        // Insert new authors if they do not exist, and insert author_book rows in DB

        foreach ($authors as $author) {
            // print_r($author);
            DB::table('authors')->updateOrInsert([
                'name' => $author,
            ]);

            $author = Author::where('name', $author)->first();
            $book = Book::where('title', $title)->first();

            DB::table('author_book')->updateOrInsert([
                'author_id' => $author->id,
                'book_id' => $book->id,
            ]);
        }

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

    //
    //
    // TODO: GET UPDATE TO WORK
    //

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:191',
            'description' => 'required',
            'publish_date' => 'required',
            'page_count' => 'required',
            'image' => 'nullable',
            'publisher_id' => 'required',
            'isbn' => 'nullable|alpha_num|size:13|unique:books,isbn,' . $id,
        ]);

        $book = Book::findOrFail($id);

        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->publish_date = $request->input('publish_date');
        $book->page_count = $request->input('page_count');
        $book->isbn = $request->input('isbn');
        $book->publisher_id = $request->input('publisher_id');

        if ($request->hasFile('image')) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $filename = uniqid() . '.' . $ext;
            $image->storeAs('public/images', $filename);
            Storage::delete("public/images/{$book->image}");
            $book->image = $filename;
        }

        $book->save();

        return redirect()->route('admin.books.index');
    }
}
