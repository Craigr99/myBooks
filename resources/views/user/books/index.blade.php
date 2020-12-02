@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container-fluid">
        <div class="row mt-5">
            @include('inc.user.sidebar')
            <div class="col-sm-8 col-lg-9 col-xl-10">
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
@endsection
