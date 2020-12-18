<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Auth;
use Illuminate\Http\Request;

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
