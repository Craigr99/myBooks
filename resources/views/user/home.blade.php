@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.user.sidebar')
            <div class="col-sm-8 col-lg-9 col-xl-10">
                <x-flash-message />
                @include('inc.navbar')
                <main class="text-lg-left mt-5 px-3">
                    <h3 class="">Welcome back <span>{{ Auth::user()->f_name }}</span></h3>
                    {{-- Current Books --}}
                    <section class="mt-5">
                        <h4 class="text-gray-1">Your books</h4>
                        <h5 class="my-4">
                            <a href="{{ route('user.books.shelf.index', 'reading') }}" class="text-primary-400">
                                Currently reading
                            </a>
                        </h5>
                        <div class="row">
                            @forelse(Auth::user()->reading()->latest()->paginate(3) as $book)
                                <div class="col-12 col-lg-6 col-xl-4 d-flex">
                                    <a href="{{ route('books.search.show', $book->id) }}">
                                        <div class="card shadow rounded mb-4 w-100">
                                            <div class="card-body py-4 text-center">
                                                <img src="{{ $book->image }}" class="mb-4 image-fill rounded" height="220px">
                                                <h6 class="text-primary-700"> {{ $book->title }}</h6>
                                                <h6 class="my-4 text-gray-1"> {{ $book->authors[0]->name }}</h6>
                                                <hr class="w-75">
                                                <div class="d-flex flex-column px-5 mt-4">
                                                    <form action="{{ route('user.books.store', $book->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn my-btn my-btn-danger w-100"><i
                                                                class="fas fa-minus-circle"></i> <span class="mx-2">Remove
                                                                book</span></button>
                                                    </form>
                                                    <a href="{{ route('user.reviews.create', [$book->id, $book->title]) }}"
                                                        class="btn my-btn my-btn-secondary mt-3"><i class="fas fa-pen"></i>
                                                        <span class="mx-2">Write a
                                                            review</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <p class="ml-3">No books found in this shelf.</p>
                            @endforelse
                        </div>
                    </section>

                    {{-- Want to read Books --}}
                    <section class="mt-5">
                        <h5 class="my-4">
                            <a href="{{ route('user.books.shelf.index', 'later') }}" class="text-primary-400">
                                Want to read
                            </a>
                        </h5>
                        <div class="row">
                            @forelse(Auth::user()->readLater()->latest()->paginate(3) as $book)
                                <div class="col-12 col-lg-6 col-xl-4 d-flex">
                                    <a href="{{ route('books.search.show', $book->id) }}">
                                        <div class="card shadow rounded mb-4 w-100">
                                            <div class="card-body py-4 text-center">
                                                <img src="{{ $book->image }}" class="mb-4 image-fill rounded" height="220px">
                                                <h6 class="text-primary-700"> {{ $book->title }}</h6>
                                                <h6 class="my-4 text-gray-1"> {{ $book->authors[0]->name }}</h6>
                                                <hr class="w-75">
                                                <div class="d-flex flex-column px-5 mt-4">
                                                    <form action="{{ route('user.books.store', $book->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn my-btn my-btn-danger w-100"><i
                                                                class="fas fa-minus-circle"></i> <span class="mx-2">Remove
                                                                book</span></button>
                                                    </form>
                                                    <a href="{{ route('user.reviews.create', [$book->id, $book->title]) }}"
                                                        class="btn my-btn my-btn-secondary mt-3"><i class="fas fa-pen"></i>
                                                        <span class="mx-2">Write a
                                                            review</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <p class="ml-3">No books found in this shelf.</p>
                            @endforelse
                        </div>
                    </section>

                    {{-- Finished Books --}}
                    <section class="mt-5">
                        <h5 class="my-4">
                            <a href="{{ route('user.books.shelf.index', 'finished') }}" class="text-primary-400">
                                Finished reading
                            </a>
                        </h5>
                        <div class="row">
                            @forelse(Auth::user()->finishedReading()->latest()->paginate(3) as $book)
                                <div class="col-12 col-lg-6 col-xl-4 d-flex">
                                    <a href="{{ route('books.search.show', $book->id) }}">
                                        <div class="card shadow rounded mb-4 w-100">
                                            <div class="card-body py-4 text-center">
                                                <img src="{{ $book->image }}" class="mb-4 image-fill rounded" height="220px">
                                                <h6 class="text-primary-700"> {{ $book->title }}</h6>
                                                <h6 class="my-4 text-gray-1"> {{ $book->authors[0]->name }}</h6>
                                                <hr class="w-75">
                                                <div class="d-flex flex-column px-5 mt-4">
                                                    <form action="{{ route('user.books.store', $book->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn my-btn my-btn-danger w-100"><i
                                                                class="fas fa-minus-circle"></i> <span class="mx-2">Remove
                                                                book</span></button>
                                                    </form>
                                                    <a href="{{ route('user.reviews.create', [$book->id, $book->title]) }}"
                                                        class="btn my-btn my-btn-secondary mt-3"><i class="fas fa-pen"></i>
                                                        <span class="mx-2">Write a
                                                            review</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <p class="ml-3">No books found in this shelf.</p>
                            @endforelse
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </div>
@endsection
