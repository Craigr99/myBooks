@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.user.sidebar')
            <div class="col">
                <x-flash-message />
                @include('inc.navbar')
                <div class="col-sm-8 col-lg-9 col-xl-10 mt-5">
                    <main class="text-center text-lg-left">
                        <h4>Want to read</h4>
                        <div class="row mt-4">
                            @forelse(Auth::user()->readLater as $book)
                                <div class="col-4">
                                    <div class="card shadow rounded mb-4" style="min-height: 500px">
                                        <div class="card-body">
                                            <img src="{{ $book->image }}" class="mb-4 ">
                                            <h6> {{ $book->title }}</h6>
                                            <p> {{ $book->description }}</p>
                                            <h6> {{ $book->publish_date }}</h6>
                                            <h6> {{ $book->page_count }}</h6>
                                            <h6> {{ $book->publisher->name }}</h6>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h5 class="ml-3 text-primary-400">No books found in this shelf</h5>
                            @endforelse
                        </div>

                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection
