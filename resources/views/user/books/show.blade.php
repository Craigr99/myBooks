@extends('layouts.app')

@section('content')
    @include('inc.navbar')
    {{-- {{ dd($item) }} --}}
    <div class="container">
        <div class="row mt-5">
            <div class="col-2">
                <img class="rounded" src="{{ $item['volumeInfo']['imageLinks']['thumbnail'] }}" width="160px"
                    alt="Book cover image">
                <a class="btn my-btn my-btn-primary mt-4 mb-4 w-100" href="#">Add to list</a>
                <a class="btn my-btn my-btn-secondary w-100" href="#">Write a review</a>
            </div>
            <div class="col-7">
                <div class="d-flex justify-content-between">
                    <div class="w-75">
                        @foreach ($item['volumeInfo']['categories'] as $category)
                            <p class="subtitle-2 text-purple">
                                {{ $category }}
                            </p>
                        @endforeach
                        <h3>{{ $item['volumeInfo']['title'] }}</h3>
                    </div>
                    <h1 class="text-gray-3">{{ $item['volumeInfo']['averageRating'] }}/5</h1>
                </div>
                <h6>by
                    @foreach ($item['volumeInfo']['authors'] as $author)
                        <span class="text-purple">{{ $author }} | </span>
                    @endforeach
                </h6>

                <p class="mt-5">{{ Str::limit($item['volumeInfo']['description'], 500) }}</p>

                <div class="reviews mt-5 red">
                    <h4>Reviews</h4>
                </div>
            </div>

            <div class="col-3"></div>
        </div>
    </div>
    </div>
@endsection
