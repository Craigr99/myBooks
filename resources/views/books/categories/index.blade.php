@extends('layouts.app')
@section('content')
    <div class="container">
        @include('inc.navbar')
    </div>
    <nav class="bg-gray-6">
        <div class="container d-flex justify-content-between align-items-center">
            <ul class="py-3 d-flex w-75 justify-content-between">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('categories.books.index', $category->id) }}" class="text-primary-500">
                            <h6>{{ $category->name }}</h6>
                        </a>
                    </li>

                @endforeach
            </ul>
            <ul class="d-flex justify-content-between">
                <li class="mr-5"><a href="#" class="text-primary-500">
                        <h6>Blog</h6>
                    </a></li>
                <li><a href="#" class="text-primary-500">
                        <h6>Discussion</h6>
                    </a></li>
            </ul>
        </div>
    </nav>

    <header class="text-center bg-gray-7 py-7">
        <h3>{{ $cat->name }} Books</h3>
    </header>

    <div class="container mt-5">
        <div class="row">
            @foreach ($books as $book)
                <div class="col-12 d-flex">
                    <a class="d-flex flex-column flex-md-row text-black" href="{{ route('books.search.show', $book->id) }}">
                        <div class="card shadow rounded mb-5 flex-1">
                            <div class="card-body">
                                <div class="d-flex flex-column flex-md-row">
                                    <div class=" text-center text-md-left">
                                        <img src="{{ $book->image }}" class="mb-3 rounded" height="300px">
                                    </div>
                                    <div class="d-flex flex-column mt-3 ml-3">
                                        <p class="text-gray-3 mb-2">4.5</p>
                                        <h5 class="font-medium text-primary-500 mb-2"> {{ $book->title }}</h5>
                                        <h6 class="mt-3 mb-4">Author: {{ $book->authors[0]->name }} | Release
                                            Date: {{ date('d-m-Y', strtotime($book->publish_date)) }}
                                        </h6>
                                        <p class=" w-90">
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

                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mb-5 ">
            {!! $books->links('pagination::bootstrap-4') !!}
        </div>
    </div>
@endsection
