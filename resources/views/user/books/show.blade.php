@extends('layouts.app')

@section('content')
    <div class="container">
        @include('inc.navbar')
        <div class="row mt-5">
            <div class="col col-sm-4 col-lg-3 col-xl-2 text-center text-sm-left mb-5 mb-sm-0">
                <img class="rounded" src="{{ $book->image }}" width="160px" alt="Book cover image">
                @if (Auth::user()->hasRole('admin'))
                    <form action="{{ route('admin.books.add', $book['volumeInfo']['title']) }}" method="POST">
                        @csrf
                        <button class="btn my-btn my-btn-primary mt-4 mb-4 w-100" type="submit">Save to database</button>
                    </form>
                @else

                    @if (Auth::user()->hasBook($book))
                        <form action="{{ route('user.books.store', $book->id) }}" method="POST">
                            @csrf
                            <button class="btn my-btn my-btn-primary mt-4 w-100" name="remove" type="submit"><i
                                    class="fas fa-minus-circle"></i> <span class="mx-2">Remove book</span></button>
                        </form>
                    @else
                        <div class="btn-group" role="group" style="display: flex">
                            <button id="btnGroupDrop1" type="button"
                                class="btn my-btn my-btn-primary mt-4 w-100 dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bookmark"></i> <span class="mx-2">Add to shelf</span>
                            </button>
                            <div class="dropdown-menu w-100" aria-labelledby="btnGroupDrop1"
                                style="border: none; padding:none; margin:none">
                                <form action="{{ route('user.books.store', $book->id) }}" method="POST">
                                    @csrf
                                    <input class="dropdown-item py-2 my-btn-light w-100" name="later" value="Want to read"
                                        type="submit" />
                                    <input class="dropdown-item py-2 my-btn-light w-100" name="reading"
                                        value="Currently reading" type="submit" />
                                    <input class="dropdown-item py-2 my-btn-light w-100" name="finished"
                                        value="Finished reading" type="submit" />
                                </form>
                            </div>
                        </div>
                    @endif
                @endif
                <a class="btn my-btn my-btn-secondary mt-3 w-100" href="#"><i class="fas fa-pen"></i> <span
                        class="mx-2">Write a review</span></a>
            </div>
            <div class="col col-sm-8 col-lg-5 col-xl-7 mb-5 mb-md-0">
                <div class="d-flex justify-content-between">
                    <div class="w-75">
                        @foreach ($book->categories as $category)
                            <p class="subtitle-2 text-primary-500" name="category">
                                {{ $category->name }}
                            </p>
                        @endforeach

                        <h3>{{ $book->title }}</h3>
                    </div>
                    <h1 class="text-gray-3">
                        {{ $book->rating }}/5
                    </h1>
                </div>
                <h6>by
                    @foreach ($book->authors as $author)
                        <span class="text-primary-500">{{ $author->name }} | </span>
                    @endforeach
                </h6>
                <p class="mt-5">{{ Str::limit($book->description, 500) }}</p>
            </div>

            <div class="col d-md-none d-lg-block col-lg-4 col-xl-3">
                <div class="card rounded shadow">
                    <div class="header">
                        <h6>Book information</h6>
                    </div>
                    <div class="card-body">
                        <ul class="d-flex justify-content-between mb-3">
                            <li><b>Publisher:</b></li>
                            <li>
                                {{ $book->publisher->name }}
                            </li>
                        </ul>
                        <ul class="d-flex justify-content-between mb-3">
                            <li><b>Publish date:</b></li>
                            <li>
                                {{ $book->publish_date }}
                            </li>
                        </ul>
                        <ul class="d-flex justify-content-between mb-3">
                            <li><b>Page Count:</b></li>
                            <li>
                                {{ $book->page_count }}
                            </li>
                        </ul>
                        <ul class="d-flex justify-content-between mb-3">
                            <li><b>Average Rating:</b></li>
                            <li>
                                {{ $book->rating }}
                            </li>
                        </ul>
                        <ul class="d-flex justify-content-between mb-3">
                            <li><b>Rating Count:</b></li>
                            <li>
                                {{ $book->rating_count }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-7 offset-lg-3 offset-xl-2">
                <div class="reviews spacer-top-lg red">
                    <h4>Book reviews</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
