@extends('layouts.app')
@section('content')
    <div class="container">
        @include('inc.navbar')
    </div>

    @include('inc.secondary-nav')

    {{-- Carousel --}}
    <header>
        <div class="bg-gray-7 py-5">
            <div class="container text-center">
                <h2>Welcome to myBooks</h2>
                <h4 class="mt-3 text-primary-500">Start exploring books</h4>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="text-center w-100 spacer-top-sm">
            <h3>Books of the week</h3>
        </div>

        <div class="spacer-top-sm">
            <div class="row">
                @foreach ($popularBooks as $book)
                    <div class="col-12 col-sm-6 col-md-4 d-flex">
                        <a class="d-flex text-black w-100" href="{{ route('books.search.show', $book->id) }}">
                            <div class="card shadow rounded mb-4 flex-1 hover-shadow">
                                <div class="card-body text-center text-lg-left">
                                    <div class="text-center">
                                        <img src="{{ $book->image }}" class="mb-3 rounded" height="280px">
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <p class="text-gray-3 mr-3"> {{ number_format($book->avgRating(), 1) }}/5</p>
                                        @foreach ($book->categories as $category)
                                            <span
                                                class="badge badge-pill badge-primary align-self-center">{{ $category->name }}</span>

                                        @endforeach
                                    </div>
                                    <h5 class=" text-primary-500 mb-2"> {{ $book->title }}</h5>
                                    <h6 class="font-light mb-3"> {{ $book->authors[0]->name }}</h6>
                                </div>
                                <div class="bg-white mt-auto text-center text-lg-left pb-4 ml-lg-4 rounded">
                                    <p class="text-gray-3"> {{ substr($book->publish_date, 0, 4) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="text-center w-100 spacer-top-sm">
            <h3>Our picks</h3>
        </div>

        <div class="spacer-top-sm">
            <div class="row">
                @foreach ($picksBooks as $book)
                    <div class="col-12 col-sm-6 col-md-4 d-flex">
                        <a class="d-flex text-black w-100" href="{{ route('books.search.show', $book->id) }}">
                            <div class="card shadow rounded mb-4 flex-1 hover-shadow">
                                <div class="card-body text-center text-lg-left">
                                    <div class="text-center">
                                        <img src="{{ $book->image }}" class="mb-3 rounded" height="280px">
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <p class="text-gray-3 mr-3"> {{ number_format($book->avgRating(), 1) }}/5</p>
                                        @foreach ($book->categories as $category)
                                            <span
                                                class="badge badge-pill badge-primary align-self-center">{{ $category->name }}</span>

                                        @endforeach
                                    </div>
                                    <h5 class=" text-primary-500 mb-2"> {{ $book->title }}</h5>
                                    <h6 class="font-light mb-3"> {{ $book->authors[0]->name }}</h6>
                                </div>
                                <div class="bg-white mt-auto text-center text-lg-left pb-4 ml-lg-4 rounded">
                                    <p class="text-gray-3"> {{ substr($book->publish_date, 0, 4) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="text-center w-100 spacer-top-sm">
            <h3>Reviews of the week</h3>
        </div>

        <div class="spacer-top-sm">
            <div class="row">
                @foreach ($popularReviews as $review)
                    <div class="col-12 col-sm-6 col-md-4 d-flex">
                        <div class="card rounded shadow-lg mt-4 w-100 hover-shadow">
                            <div class="card-body">
                                {{-- REVIEW Card --}}
                                <a href="{{ route('user.reviews.show', $review->id) }}">
                                    <div class="d-flex">
                                        {{-- Profile image --}}
                                        @if ($review->user->image !== 'default.png')
                                            <a href="{{ route('user.profile.index', $review->user->id) }}">
                                                <img src="{{ asset('storage/images/' . $review->user->image) }}"
                                                    class="rounded-circle image-fill" height="60px" width="60px" />
                                            </a>
                                        @else
                                            <a href="{{ route('user.profile.index', $review->user->id) }}">
                                                <img src="{{ asset('img/default.png') }}"
                                                    class="rounded-circle image-fill border" height="60px" width="60px" />
                                            </a>
                                        @endif
                                        <div class="ml-4 w-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4>{{ $review->rating }}/5</h4>
                                                <small
                                                    class="caption text-gray-4">{{ $review->created_at->diffForHumans() }}</small>
                                            </div>
                                            <a href="{{ route('user.reviews.show', $review->id) }}">

                                                <h5 class="mt-4 mb-3">{{ $review->title }}</h5>
                                            </a>
                                            <p>{{ $review->body }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('inc.footer')
@endsection
