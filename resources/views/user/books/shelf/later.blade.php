@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('inc.user.sidebar')
            <div class="col bg-gray-7">
                <x-flash-message />
                @include('inc.navbar')
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="card rounded p-5">
                            <main class="text-center">
                                <h4>Want to Read</h4>
                                <div class="row mt-5">
                                    @forelse(Auth::user()->readLater as $book)
                                        <div class="col-12 col-lg-6 col-xl-4 d-flex">
                                            <a href="{{ route('books.search.show', $book->id) }}">
                                                <div class="card shadow rounded mb-4 w-100 hover-shadow">
                                                    <div class="card-body py-4 text-center">
                                                        <img src="{{ $book->image }}" class="mb-4 image-fill rounded"
                                                            height="220px">
                                                        <h6 class="text-primary-700"> {{ $book->title }}</h6>
                                                        <h6 class="my-4 text-gray-1"> {{ $book->authors[0]->name }}</h6>
                                                        <hr class="w-75">
                                                        <div class="d-flex flex-column px-5 mt-4">
                                                            <form action="{{ route('user.books.store', $book->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button class="btn my-btn my-btn-danger w-100"><i
                                                                        class="fas fa-minus-circle"></i> <span
                                                                        class="mx-2">Remove
                                                                        book</span></button>
                                                            </form>
                                                            <a href="{{ route('user.reviews.create', [$book->id, $book->title]) }}"
                                                                class="btn my-btn my-btn-secondary mt-3"><i
                                                                    class="fas fa-pen"></i> <span class="mx-2">Write a
                                                                    review</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="text-center w-100">
                                            <h5 class="text-primary-400">No books found in this shelf</h5>
                                        </div>
                                    @endforelse
                                </div>

                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
