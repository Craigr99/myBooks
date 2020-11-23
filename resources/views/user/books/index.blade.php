@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container">
        <div class="row">
            @if (isset($data))
                @foreach ($data as $item)
                    <div class="col-3">
                        <a href="{{ route('books.show', [$item['id'], $item['volumeInfo']['title']]) }}">
                            <div class="card mb-4" style="min-height: 500px">
                                <div class="card-body">
                                    <img src="{{ $item['volumeInfo']['imageLinks']['thumbnail'] }}" class="mb-4">
                                    <h6> {{ $item['volumeInfo']['title'] }}</h6>

                                </div>
                                <div class="card-footer">
                                    <p><b>Authors</b> {{ implode('  ', $item['volumeInfo']['authors']) }}
                                    </p>
                                    <p><b>Published</b>
                                        {{ $item['volumeInfo']['publishedDate'] }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <h5>There are no books found matching this search. <a href="{{ route('home') }}">Try
                        Again</a></h5>
            @endif
        </div>
    </div>
    </div>
@endsection
