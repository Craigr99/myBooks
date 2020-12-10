@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.user.sidebar')
            <div class="col">
                @include('inc.navbar')
                <div class="col-sm-8 col-lg-9 col-xl-10 mt-5">
                    <main class="text-center text-lg-left">
                        <h4>Saved books</h4>
                        <div class="row">
                            @foreach (Auth::user()->books as $book)
                                {{ $book->pivot->status }}
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
                            @endforeach
                        </div>

                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection
