@extends('layouts.app')

@section('content')

    <div class="container">
        @include('inc.navbar')
        <div class="row">
            @if (isset($data))
                @foreach ($data as $item)
                    <div class="col-md-4 d-flex">
                        <a class="d-flex text-black w-100"
                            href="{{ route('books.search.show', [$item['id'], $item['volumeInfo']['title']]) }}">
                            <div class="card shadow rounded mb-4 flex-1">
                                <div class="card-body">
                                    @if (isset($item['volumeInfo']['imageLinks']['thumbnail']))
                                        <div class="text-center">
                                            <img src="{{ $item['volumeInfo']['imageLinks']['thumbnail'] }}" class="mb-4 ">
                                        </div>
                                    @endif
                                    <h5 class="font-medium text-primary-500 mb-2"> {{ $item['volumeInfo']['title'] }}</h5>
                                    @if (isset($item['volumeInfo']['authors']))
                                        <h6 class="font-light mb-3"> {{ implode('  ', $item['volumeInfo']['authors']) }}
                                        </h6>
                                    @else
                                        Not found
                                    @endif

                                </div>
                                {{-- card footer --}}
                                <div class="ml-4 bg-white mt-auto">
                                    @if (isset($item['volumeInfo']['publishedDate']))
                                        <p class="text-gray-3">
                                            {{ date('d-m-Y', strtotime($item['volumeInfo']['publishedDate'])) }} </p>
                                    @else
                                        Not found
                                    @endif
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
