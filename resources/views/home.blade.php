@extends('layouts.app')
@section('content')
    <div class="container">
        @include('inc.navbar')
    </div>

    @include('inc.secondary-nav')

    {{-- Carousel --}}
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
        <div class="row mt-5">
            @foreach ($books as $book)
                <div class="col-12 col-sm-6 col-md-4 d-flex">
                    <a class="d-flex text-black w-100" href="{{ route('books.search.show', $book->id) }}">
                        <div class="card shadow rounded mb-4 flex-1">
                            <div class="card-body text-center text-lg-left">
                                <div class="text-center">
                                    <img src="{{ $book->image }}" class="mb-3 rounded img-fluid">
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <p class="text-gray-3 mr-3">4.5</p>
                                    @foreach ($book->categories as $category)
                                        <span
                                            class="badge badge-pill badge-primary align-self-center">{{ $category->name }}</span>

                                    @endforeach
                                </div>
                                <h5 class=" text-primary-500 mb-2"> {{ $book->title }}</h5>
                                <h6 class="font-light mb-3"> {{ $book->authors[0]->name }}</h6>
                            </div>
                            <div class="bg-white mt-auto text-center text-lg-left pb-4 ml-lg-4">
                                <p class="text-gray-3"> {{ substr($book->publish_date, 0, 4) }}</p>
                            </div>
                        </div>
                    </a>

                </div>
            @endforeach
        </div>
    </div>
@endsection
