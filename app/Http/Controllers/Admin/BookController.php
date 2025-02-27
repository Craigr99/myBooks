<?php
# @Date:   2021-01-18T10:09:10+00:00
# @Last modified time: 2021-01-23T14:37:06+00:00

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
        $books = Book::orderBy('created_at', 'ASC')->paginate(10);

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
        $book->id = Str::random(10);
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

        $request->session()->flash('success', 'Book added successfully!');

        return redirect()->route('admin.books.index');
    }

    //
    // Add book to databse from admin searching a book using the API
    //
    public function add(Request $request, $title)
    {
        // Get the book from response
        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => $title,
        ]);

        // Set variables
        // dd($response->json()['items'][0]);
        $book = $response->json()['items'][0]['volumeInfo'];
        $book_id = $response->json()['items'][0]['id'];

        // If a book with the title & date exists, return error
        if (DB::table('books')->where('title', $book['title'])->orWhere('publish_date', $book['publishedDate'])->first()) {
            $request->session()->flash('danger', 'ERROR - Book already stored in the database!');
            return redirect()->route('admin.books.index');
        } else {
            // Add new book
            isset($book_id) ? $id = $book_id : $id = 'NULL';
            isset($book['title']) ? $title = $book['title'] : $title = 'Not found';
            isset($book['publishedDate']) ? $publish_date = $book['publishedDate'] : $publish_date = 'Not found';
            isset($book['description']) ? $description = $book['description'] : $description = 'Not found';
            isset($book['publisher']) ? $publisher = $book['publisher'] : $publisher = 'Not found';
            isset($book['imageLinks']['thumbnail']) ? $image = $book['imageLinks']['thumbnail'] : $image = 'Not found';
            isset($book['pageCount']) ? $page_count = $book['pageCount'] : $page_count = 0;
            isset($book['authors']) ? $authors = $book['authors'] : $authors = 'Not found';
            isset($book['categories']) ? $categories = $book['categories'] : $categories = 'Not found';

            // Insert new or update Publisher in publishers table
            if (isset($book['publisher'])) {
                DB::table('publishers')->updateOrInsert([
                    'name' => $publisher,
                ]);
            }

            $publisher = Publisher::where('name', $publisher)->first();
            // Insert new or update Book in books table
            DB::table('books')->updateOrInsert([
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'publish_date' => $publish_date,
                'page_count' => $page_count,
                'image' => $image,
                'publisher_id' => $publisher->id,
            ]);

            // Insert new category if it does not exist, and insert book category row in DB
            if (isset($book['categories'])) {
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
            }

            // Insert new authors if they do not exist, and insert author_book rows in DB
            if (isset($book['authors'])) {
                foreach ($authors as $author) {
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

        }

        $request->session()->flash('success', 'Book added successfully!');

        return redirect()->route('admin.books.index');
    }

    public function destroy(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $reviews = $book->reviews();

        $reviews->delete();

        $book->delete();

        $request->session()->flash('danger', 'Book removed successfully!');

        return redirect()->route('admin.books.index');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        $reviews = $book->reviews;

        return view('admin.books.show', [
            'book' => $book,
            'reviews' => $reviews,
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

        $request->session()->flash('info', 'Book updated successfully!');

        return redirect()->route('admin.books.index');
    }
}
