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
            @forelse ($books as $book)
                <div class="col-12 d-flex">
                    <a class="d-flex flex-column flex-md-row text-black" href="{{ route('books.search.show', $book->id) }}">
                        <div class="card shadow rounded mb-5 flex-1">
                            <div class="card-body text-center text-md-left">
                                <div class="d-flex flex-column flex-md-row">
                                    <div class=" text-center text-md-left">
                                        <img src="{{ $book->image }}" class="mb-3 rounded" />
                                    </div>
                                    <div class="d-flex flex-column mt-3 ml-3">
                                        <p class="text-gray-3 mb-2">4.5</p>
                                        <h5 class="font-medium text-primary-500 mb-2"> {{ $book->title }}</h5>
                                        <p class="mt-3 mb-4">Author: {{ $book->authors[0]->name }} | Release
                                            Date: {{ date('d-m-Y', strtotime($book->publish_date)) }}
                                        </p>
                                        <p class="w-lg-90 text-gray-3">
                                            {{ $book->description }}
                                        </p>
                                    </div>
                                    <div class="buttons">
                                        <x-button-dropdown :book="$book"></x-button-dropdown>
                                        <a class="btn my-btn my-btn-secondary my-btn-small mt-3 w-100"
                                            href="{{ route('user.reviews.create', $book->id) }}"><i
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
