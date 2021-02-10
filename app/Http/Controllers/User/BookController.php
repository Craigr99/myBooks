<?php
# @Date:   2021-01-18T10:09:10+00:00
# @Last modified time: 2021-01-23T15:02:46+00:00

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {
        return view("user.books.shelf." . $name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $user = Auth::user();

        //Check if user has book in shelf
        if ($user->hasBook($book)) {
            // Remove the book
            $user->removeBook($book);
            $request->session()->flash('danger', 'Book successfully removed from your shelf!');
            return redirect()->route('user.books.shelf.index', 'reading');
        } else {
            // Check what list they selected and save the book
            if ($request->input('later')) {
                $user->readLater()->attach($id, ['shelf' => 'Read Later']);
                $request->session()->flash('success', 'Book successfully added to your shelf!');

                return redirect()->route('user.books.shelf.index', 'later');
            } else if ($request->input('reading')) {
                $user->reading()->attach($id, ['shelf' => 'Reading']);
                $request->session()->flash('success', 'Book successfully added to your shelf!');

                return redirect()->route('user.books.shelf.index', 'reading');
            } else {
                $user->finishedReading()->attach($id, ['shelf' => 'Finished Reading']);
                $request->session()->flash('success', 'Book successfully added to your shelf!');

                return redirect()->route('user.books.shelf.index', 'finished');
            }
        }

    }

    public function storeGoogleBook(Request $request, $title)
    {
        // Get the book from response
        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => $title,
        ]);

        // Set variables
        $book = $response->json()['items'][0]['volumeInfo'];
        $book_id = $response->json()['items'][0]['id'];

        // If book does not exist in database
        if (!Book::where('id', $book_id)->first()) {
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

            $book = Book::findOrFail($id);
            $user = Auth::user();

            //Check if user has book in shelf
            if ($user->hasBook($book)) {
                // Remove the book
                $user->removeBook($book);
                $request->session()->flash('danger', 'Book successfully removed from your shelf!');
                return redirect()->route('user.books.shelf.index', 'reading');
            } else {
                // Check what list they selected and save the book
                if ($request->input('later')) {
                    $user->readLater()->attach($id, ['shelf' => 'Read Later']);
                    $request->session()->flash('success', 'Book successfully added to your shelf!');

                    return redirect()->route('user.books.shelf.index', 'later');
                } else if ($request->input('reading')) {
                    $user->reading()->attach($id, ['shelf' => 'Reading']);
                    $request->session()->flash('success', 'Book successfully added to your shelf!');

                    return redirect()->route('user.books.shelf.index', 'reading');
                } else {
                    $user->finishedReading()->attach($id, ['shelf' => 'Finished Reading']);
                    $request->session()->flash('success', 'Book successfully added to your shelf!');

                    return redirect()->route('user.books.shelf.index', 'finished');
                }
            }

        } else {
            // If the book exists in the database, just add to users bookshelf
            $id = $response->json()['items'][0]['id'];
            $book = Book::findOrFail($id);
            $user = Auth::user();

            //Check if user has book in shelf
            if ($user->hasBook($book)) {
                // Remove the book
                $user->removeBook($book);
                $request->session()->flash('danger', 'Book successfully removed from your shelf!');
                return redirect()->route('user.books.shelf.index', 'reading');
            } else {
                // Check what list they selected and save the book
                if ($request->input('later')) {
                    $user->readLater()->attach($id, ['shelf' => 'Read Later']);
                    $request->session()->flash('success', 'Book successfully added to your shelf!');

                    return redirect()->route('user.books.shelf.index', 'later');
                } else if ($request->input('reading')) {
                    $user->reading()->attach($id, ['shelf' => 'Reading']);
                    $request->session()->flash('success', 'Book successfully added to your shelf!');

                    return redirect()->route('user.books.shelf.index', 'reading');
                } else {
                    $user->finishedReading()->attach($id, ['shelf' => 'Finished Reading']);
                    $request->session()->flash('success', 'Book successfully added to your shelf!');

                    return redirect()->route('user.books.shelf.index', 'finished');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $reviews = $book->reviews;

        return view('admin.books.show', [
            'book' => $book,
            'reviews' => $reviews,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
