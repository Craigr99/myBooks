<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
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
        $categories = Category::all();

        return view('home', [
            'books' => $books,
            'categories' => $categories,
        ]);
    }
}
