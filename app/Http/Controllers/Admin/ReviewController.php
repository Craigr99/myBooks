<?php
# @Date:   2021-01-23T13:49:58+00:00
# @Last modified time: 2021-02-08T01:23:28+00:00




namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Auth;

class ReviewController extends Controller
{

  public function __construct(){
    $this->middleware('auth');
    $this->middleware('role:admin,moderators');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $reviews = Review::paginate(10);

      return view('admin.reviews.index', [
          'reviews' => $reviews,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $book = Book::findOrFail($id);

      return view('admin.books.reviews.create', [
        'book' => $book
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
      $review = new Review();
      $review->title = $request->input('title');
      $review->body = $request->input('body');
      $review->user_id = Auth::id();
      $review->book_id = $id;
      $review->save();

      return redirect()->route('admin.books.show', $id);
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
    public function destroy($id, $rid)
    {
        $review = Review::findOrFail($rid);

        $review->delete();

        $request->session()->flash('danger', 'Review removed successfully!');

        return redirect()->route('admin.reviews.index');

    }
}
