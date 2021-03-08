@extends('layouts.app')
@section('content')
    <div class="container">
        @include('inc.navbar')
    </div>

    @include('inc.secondary-nav')


    <header class="text-center bg-gray-7 py-7">
        <h3>{{ $cat->name }} Books</h3>
    </header>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                @forelse ($books as $book)
                    <a class="d-flex flex-column flex-md-row text-black" href="{{ route('books.search.show', $book->id) }}">
                        <div class="card shadow rounded mb-5 flex-1">
                            <div class="card-body text-center text-md-left">
                                <div class="d-flex flex-column flex-md-row">
                                    <div class=" text-center text-md-left">
                                        <img src="{{ $book->image }}" class="mb-3 rounded" />
                                    </div>
                                    <div class="d-flex flex-column mt-3 ml-3">
                                        <p class="text-gray-3 mb-2"> {{ number_format($book->avgRating(), 1) }}/5</p>
                                        <h5 class="font-medium text-primary-500 mb-2"> {{ $book->title }}</h5>
                                        <p class="mt-3 mb-4">Author: {{ $book->authors[0]->name }} | Release
                                            Date: {{ date('d-m-Y', strtotime($book->publish_date)) }}
                                        </p>
                                        <p class="w-lg-90 text-gray-3">
                                            {{ $book->description }}
                                        </p>
                                    </div>
                                    <div class="buttons ml-md-auto">
                                        @if (Auth::user()->hasRole('admin'))
                                            <form action="{{ route('books.destroy', $book->title) }}" method="POST">
                                                <input type="hidden" value="DELETE" name="_method">
                                                @csrf
                                                <button class="btn my-btn my-btn-small my-btn-danger mt-4 mb-4 w-100"
                                                    type="submit"><i class="fas fa-minus-circle mr-2"></i> Remove
                                                    book</button>
                                            </form>

                                        @else
                                            <x-button-dropdown :book="$book"></x-button-dropdown>
                                        @endif
                                        <a class="btn my-btn my-btn-secondary my-btn-small mt-3 w-100"
                                            href="{{ route('user.reviews.create', [$book->id, $book->title]) }}"><i
                                                class="fas fa-pen mr-2"></i>Write
                                            a
                                            review</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="w-100 text-center">
                        <h4>No {{ $cat->name }} books found </h4>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="d-flex justify-content-center mb-5 ">
            {!! $books->links('pagination::bootstrap-4') !!}
        </div>
    </div>
@endsection
