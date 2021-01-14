@extends('layouts.app')
@section('content')
    <div class="container">
        @include('inc.navbar')
    </div>
    <nav class="bg-gray-6">
        <div class="container d-flex justify-content-between align-items-center">
            <ul class="py-3 d-flex w-75 justify-content-between">
                <li>
                    <a href="#" class="text-primary-500">
                        <h6>Action</h6>
                    </a>
                </li>
                <li>
                <li>
                    <a href="#" class="text-primary-500">
                        <h6>Action</h6>
                    </a>
                </li>
                <li>
                <li>
                    <a href="#" class="text-primary-500">
                        <h6>Action</h6>
                    </a>
                </li>
                <li>
                <li>
                    <a href="#" class="text-primary-500">
                        <h6>Action</h6>
                    </a>
                </li>
                <li>
                <li>
                    <a href="#" class="text-primary-500">
                        <h6>Action</h6>
                    </a>
                </li>
                <li>
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
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&h=600&q=80"
                    class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($books as $book)
                <div class="col-4 d-flex">
                    <a class="d-flex text-black w-100" href="{{ route('books.search.show', $book->id) }}">
                        <div class="card shadow rounded mb-4 flex-1">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ $book->image }}" class="mb-3 rounded" height="300px">
                                </div>
                                <p class="text-gray-3 mb-2">4.5</p>
                                <h5 class="font-medium text-primary-500 mb-2"> {{ $book->title }}</h5>
                                <h6 class="font-light mb-3"> {{ $book->authors[0]->name }}</h6>
                            </div>
                            <div class="ml-4 bg-white mt-auto">
                                <p class="text-gray-3"> {{ substr($book->publish_date, 0, 4) }}</p>
                            </div>
                        </div>
                    </a>

                </div>
            @endforeach
        </div>
    </div>
@endsection
