@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.user.sidebar')
            <div class="col-sm-8 col-lg-9 col-xl-10">
                @include('inc.navbar')
                <main class="text-lg-left mt-5 px-3">
                    <h3 class="">Welcome back <span>{{ Auth::user()->f_name }}</span></h3>
                    {{-- Books --}}
                    <section class="mt-5">
                        <h4 class="text-gray-1">Your books</h4>
                        <h5 class="text-primary-400 my-4">Currently reading</h5>

                        <div class="row">
                            @forelse(Auth::user()->reading()->paginate(3) as $book)
                                <div class="col-12 col-md-6 col-lg-4 d-flex">
                                    <a class="d-flex text-black w-100" href="{{ route('books.search.show', $book->id) }}">
                                        <div class="card shadow rounded mb-4 flex-1">
                                            <div class="card-body text-center">
                                                <img src="{{ $book->image }}" class="mb-4 image-fill img-fluid rounded">
                                                <h6 class="text-primary-700"> {{ $book->title }}</h6>
                                                <h6 class="my-4 text-gray-1"> {{ $book->authors[0]->name }}</h6>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @empty
                                    <p class="ml-3">No books found in this shelf.</p>
                            @endforelse
                        </div>
                    </section>

                    {{-- Reviews --}}
                    <section class="mt-6">
                        <h4 class="text-gray-1">Your reviews</h4>

                        <div class="row mt-4">
                            @forelse(Auth::user()->reviews as $review)
                                <div class="col-12 col-md-6 col-lg-6 col-xl-4 d-flex">
                                    {{-- <a class="d-flex text-black w-100"
                                        href="{{ route('books.search.show', $book->id) }}"> --}}
                                        <a class="d-flex text-black w-100" href="#">
                                            <div class="card shadow rounded mb-4 flex-1">
                                                <div class="card-body d-flex flex-md-column flex-lg-row">
                                                    <img src="{{ $review->book->image }}"
                                                        class="mb-4 mb-md-0 image-fill img-fluid rounded border">
                                                    <div class="ml-3 ml-md-0 ml-lg-3 mt-3">
                                                        <h5>3.6</h5>
                                                        <h6 class="text-primary-700 mt-3 mb-4"> {{ $review->title }}</h6>
                                                        <p class="text-gray-1">"{{ $review->body }}"</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                </div>
                            @empty
                                <p class="ml-2">No reviews found.</p>
                            @endforelse

                        </div>
                    </section>
                </main>
            </div>
        </div>
    </div>
@endsection
