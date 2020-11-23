<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Http;
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
    public function index(Request $request)
    {
        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => $request->input('title'),
            // 'page' => 1,
            'maxResults' => 10,
        ]);

        if (isset($response->json()['items'])) {
            // dd($response->json()['items']);

            return view('user.books.index', [
                'data' => $response->json()['items'],
            ]);

        } else {
            return view('user.books.index', [
                'data' => null,
            ]);
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $name)
    {
        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'volumeId' => $id,
            'q' => $name,
        ]);

        return view('user.books.show', [
            'item' => $response->json()['items'][0],
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
