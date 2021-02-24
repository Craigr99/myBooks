@extends('layouts.app')

@section('content')
    <div class="container">
        @include('inc.navbar')
        <div class="row mt-5">
            <div class="col col-sm-4 col-lg-3 col-xl-2 text-center text-sm-left mb-5 mb-sm-0">
                <img class="rounded" src="{{ $book->image }}" width="160px" alt="Book cover image">
                @if (Auth::user()->hasRole('admin'))
                    @if (App\Models\Book::where('title', $book->title))
                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST">
                            @csrf
                            <input type="hidden" value="DELETE" name="_method">

                            <button class="btn my-btn my-btn-small my-btn-danger mt-4 mb-4 w-100" type="submit"><i
                                    class="fas fa-minus-circle mr-2"></i> Remove
                                book</button>
                        </form>

                    @else
                        <form action="{{ route('admin.books.add', $book->title) }}" method="POST">
                            @csrf
                            <button class="btn my-btn my-btn-small my-btn-primary mt-4 mb-4 w-100" type="submit"><i
                                    class="fas fa-bookmark"></i> Save to
                                database</button>
                        </form>
                    @endif
                @else

                    <div>
                        @if (Auth::user()->hasBook($book))
                            <form action="{{ route('user.books.store', $book->id) }}" method="POST">
                                @csrf
                                <button class="btn my-btn my-btn-small my-btn-danger mt-4 w-100" name="remove"
                                    type="submit"><i class="fas fa-minus-circle mr-2"></i>Remove book</button>
                            </form>
                        @else
                            <div class="btn-group" role="group" style="display: flex">
                                <button id="btnGroupDrop1" type="button"
                                    class="btn my-btn my-btn-primary my-btn-small mt-4 w-100 dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bookmark"></i> <span class="mx-2">Add to shelf</span>
                                </button>
                                <div class="dropdown-menu w-100" aria-labelledby="btnGroupDrop1"
                                    style="border: none; padding:none; margin:none">
                                    <form action="{{ route('user.books.store', $book->id) }}" method="POST">
                                        @csrf
                                        <input class="dropdown-item py-2 my-btn-light border w-100" name="later"
                                            value="Want to read" type="submit" />
                                        <input class="dropdown-item py-2 my-btn-light w-100" name="reading"
                                            value="Currently reading" type="submit" />
                                        <input class="dropdown-item py-2 my-btn-light border w-100" name="finished"
                                            value="Finished reading" type="submit" />
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>


                @endif

                @if (Auth::user()->hasRole('user'))
                    <a class="btn my-btn my-btn-secondary my-btn-small mt-3 w-100"
                        href="{{ route('user.reviews.create', [$book->id, $book->title]) }}"><i
                            class="fas fa-pen mr-2"></i>Write
                        a
                        review</a>
                @endif
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
                    <h2 class="text-gray-3">
                        {{ number_format($book->avgRating(), 1) }}/5
                    </h2>
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
            <div class="col-12 col-lg-5 col-xl-7 offset-lg-3 offset-xl-2 spacer-top-sm">
                <span class="d-flex align-items-center">
                    <h4>Book reviews</h4>
                    <h5 class="ml-2">({{ count($book->reviews) }})</h5>
                </span>
                @if (count($book->reviews) == 0)
                    <p>There are no reviews for this book.</p>
                @else
                    @foreach ($book->reviews as $review)
                        <div class="card rounded shadow-lg mt-4">
                            <div class="card-body">
                                {{-- Card --}}
                                <a href="{{ route('user.reviews.show', $review->id) }}" style="color: initial">
                                    <div class="d-flex">
                                        {{-- Profile image --}}
                                        @if ($review->user->image !== 'default.png')
                                            <img src="{{ asset('storage/images/' . $review->user->image) }}"
                                                class="rounded-circle image-fill" height="60px" width="60px" />
                                        @else
                                            <img src="{{ asset('img/default.png') }}"
                                                class="rounded-circle image-fill border" height="60px" width="60px" />
                                        @endif
                                        <div class="ml-4 w-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4>{{ $review->rating }}/5</h4>
                                                <small
                                                    class="caption text-gray-4">{{ $review->created_at->diffForHumans() }}</small>
                                            </div>
                                            <h5 class="mt-4 mb-3">{{ $review->title }}</h5>
                                            <p>{{ $review->body }}</p>
                                            {{-- Icons --}}
                                            <div class="mt-auto pt-4 text-gray-3">
                                                {{-- Comment button toggle --}}
                                                <a class="far fa-comment" data-toggle="collapse"
                                                    href="#commentsDropdown{{ $review->id }}" role="button"
                                                    aria-expanded="false"
                                                    aria-controls="commentsDropdown{{ $review->id }}"></a>
                                                {{ count($review->comments) }}
                                                {{-- Likes button --}}
                                                <i class="far fa-heart ml-5"></i> 3
                                                {{-- Comments dropdown --}}

                                                <div class="collapse multi-collapse mt-2"
                                                    id="commentsDropdown{{ $review->id }}">
                                                    <div class="card card-body">
                                                        <form
                                                            action="{{ route('user.review.comments.store', $review->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <label for="comment">Write a comment</label>
                                                            <div class="d-flex">
                                                                <input class="form-control form-control-sm" type="text"
                                                                    placeholder="Write a comment..">
                                                                <button type="submit"
                                                                    class="btn btn-sm my-btn-primary rounded">Post</button>
                                                            </div>
                                                        </form>
                                                        <div class="mt-3">
                                                            @foreach ($review->comments as $comment)
                                                                <hr>
                                                                <div class="comment d-flex align-items-center">
                                                                    {{-- Profile image --}}
                                                                    @if ($review->user->image !== 'default.png')
                                                                        <img src="{{ asset('storage/images/' . $review->user->image) }}"
                                                                            class="rounded-circle image-fill" height="30px"
                                                                            width="30px" />
                                                                    @else
                                                                        <img src="{{ asset('img/default.png') }}"
                                                                            class="rounded-circle image-fill border"
                                                                            height="30px" width="30px" />
                                                                    @endif
                                                                    <p class="text-black ml-3">{{ $comment->body }}</p>
                                                                    <small
                                                                        class="caption text-gray-4 ml-auto">{{ $comment->created_at->diffForHumans() }}</small>
                                                                </div>
                                                                <hr>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
