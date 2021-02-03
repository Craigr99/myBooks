@extends('layouts.app')

@section('content')
    {{-- {{ dd($item) }} --}}
    <div class="container">
        @include('inc.navbar')
        <div class="row mt-5">
            <div class="col-2">
                <img class="rounded" src="{{ $item['volumeInfo']['imageLinks']['thumbnail'] }}" width="160px"
                    alt="Book cover image">
                @if (Auth::user()->hasRole('admin'))
                    @if (App\Models\Book::where('title', '=', $item['volumeInfo']['title'])->exists())
                        <form action="{{ route('books.destroy', $item['volumeInfo']['title']) }}" method="POST">
                            <input type="hidden" value="DELETE" name="_method">
                            @csrf
                            <button class="btn my-btn my-btn-small my-btn-danger mt-4 mb-4 w-100" type="submit"><i
                                    class="fas fa-minus-circle mr-2"></i> Remove
                                book</button>
                        </form>
                    @else
                        <form action="{{ route('admin.books.add', $item['volumeInfo']['title']) }}" method="POST">
                            @csrf
                            <button class="btn my-btn my-btn-small my-btn-primary mt-4 mb-4 w-100" type="submit"><i
                                    class="fas fa-bookmark mr-2"></i> Save book</button>
                        </form>
                    @endif
                @else
                    <form action="{{ route('user.books.store', $item['id']) }}" method="POST">
                        @csrf
                        <button class="btn my-btn my-btn-light mt-4 mb-4 w-100" type="submit">Add to list</button>
                    </form>
                @endif
                @if (Auth::user()->hasRole('user'))
                    <a class="btn my-btn my-btn-small my-btn-secondary w-100" href="#"><i class="fas fa-pen mr-2"></i> Write
                        a
                        review</a>
                @endif
            </div>
            <div class="col-7">
                <div class="d-flex justify-content-between">
                    <div class="w-75">
                        @if (isset($item['volumeInfo']['categories']))
                            @foreach ($item['volumeInfo']['categories'] as $category)
                                <p class="subtitle-2 text-primary-500" name="category">
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
                            <span class="text-primary-500">{{ $author }} | </span>
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
