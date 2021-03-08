<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $home = 'home';

        if ($user->hasRole('admin')) {
            $home = 'admin.home';
        } else if ($user->hasRole('user')) {
            $home = 'user.home';
        }

        return redirect()->route($home);
    }

    public function homepage()
    {
        $books = Book::all();
        $picksBooks = Book::all()->take(3);
        $popularBooks = $books->filter(function ($book) {
            return $book->reviews->avg('rating') >= 3.5;
        })->take(3);

        $reviews = Review::all();
        $popularReviews = Review::has('likes', '>=', 2)->get()->take(3);

        $categories = Category::all();

        return view('home', [
            'books' => $books,
            'popularBooks' => $popularBooks,
            'picksBooks' => $picksBooks,
            'categories' => $categories,
            'popularReviews' => $popularReviews,
        ]);
    }
}
