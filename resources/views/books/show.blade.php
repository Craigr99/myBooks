@extends('layouts.app')

@section('content')
    @include('inc.navbar')
    {{-- {{ dd($item) }} --}}
    <div class="container">
        <div class="row mt-5">
            <div class="col-2">
                <img class="rounded" src="{{ $item['volumeInfo']['imageLinks']['thumbnail'] }}" width="160px"
                    alt="Book cover image">
                @if (Auth::user()->hasRole('admin'))
                    <form action="{{ route('admin.books.add', $item['volumeInfo']['title']) }}" method="POST">
                        @csrf
                        <button class="btn my-btn my-btn-light mt-4 mb-4 w-100" type="submit">Save to database</button>
                    </form>
                @else
                    <form action="{{ route('user.books.store', $item['id']) }}" method="POST">
                        @csrf
                        <button class="btn my-btn my-btn-light mt-4 mb-4 w-100" type="submit">Add to list</button>
                    </form>
                @endif
                <a class="btn my-btn my-btn-secondary w-100" href="#">Write a review</a>
            </div>
            <div class="col-7">
                <div class="d-flex justify-content-between">
                    <div class="w-75">
                        @if (isset($item['volumeInfo']['categories']))
                            @foreach ($item['volumeInfo']['categories'] as $category)
                                <p class="subtitle-2 text-purple-light" name="category">
                                    {{ $category }}
                                </p>
                            @endforeach
                        @else
                            Not found
                        @endif

                        <h3>{{ $item['volumeInfo']['title'] }}</h3>
                    </div>
                    <h1 class="text-gray-3">
                        @if (isset($item['volumeInfo']['averageRating']))
                            {{ $item['volumeInfo']['averageRating'] }}/5
                        @else
                            Not found
                        @endif
                    </h1>
                </div>
                <h6>by
                    @if (isset($item['volumeInfo']['authors']))
                        @foreach ($item['volumeInfo']['authors'] as $author)
                            <span class="text-purple-light">{{ $author }} | </span>
                        @endforeach
                    @else
                        Not found
                    @endif
                </h6>

                @if (isset($item['volumeInfo']['description']))
                    <p class="mt-5">{{ Str::limit($item['volumeInfo']['description'], 500) }}</p>
                @endif

                <div class="reviews spacer-top-lg red">
                    <h4>Book reviews</h4>
                </div>
            </div>

            <div class="col-3">
                <div class="card rounded shadow">
                    <div class="header">
                        <h6>Book information</h6>
                    </div>
                    <div class="card-body">
                        <ul class="d-flex justify-content-between mb-3">
                            <li><b>Publisher:</b></li>
                            <li>
                                @if (isset($item['volumeInfo']['publisher']))
                                    {{ $item['volumeInfo']['publisher'] }}
                                @else
                                    Not found
                                @endif
                            </li>
                        </ul>
                        <ul class="d-flex justify-content-between mb-3">
                            <li><b>Publish date:</b></li>
                            <li>
                                @if (isset($item['volumeInfo']['publishedDate']))
                                    {{ $item['volumeInfo']['publishedDate'] }}
                                @else
                                    Not found
                                @endif
                            </li>
                        </ul>
                        <ul class="d-flex justify-content-between mb-3">
                            <li><b>Page Count:</b></li>
                            <li>
                                @if (isset($item['volumeInfo']['pageCount']))
                                    {{ $item['volumeInfo']['pageCount'] }}
                                @else
                                    Not found
                                @endif
                            </li>
                        </ul>
                        <ul class="d-flex justify-content-between mb-3">
                            <li><b>Average Rating:</b></li>
                            <li>
                                @if (isset($item['volumeInfo']['averageRating']))
                                    {{ $item['volumeInfo']['averageRating'] }}
                                @else
                                    Not found
                                @endif
                            </li>
                        </ul>
                        <ul class="d-flex justify-content-between mb-3">
                            <li><b>Rating Count:</b></li>
                            <li>
                                @if (isset($item['volumeInfo']['ratingsCount']))
                                    {{ $item['volumeInfo']['ratingsCount'] }}
                                @else
                                    Not found
                                @endif
                            </li>
                        </ul>
                        <ul class="d-flex justify-content-between mb-3">
                            <li><b>Preview link:</b></li>
                            <li> <a href="{{ $item['volumeInfo']['previewLink'] }}">
                                    {{ Str::limit($item['volumeInfo']['previewLink'], 15) }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
