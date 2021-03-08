@extends('layouts.app')

@section('content')
    <div class="container">
        @include('inc.navbar')
        <h5 class="text-center text-lg-left mt-5 mb-4">Showing results for "{{ $data[0]['volumeInfo']['title'] }}"</h5>
        <div class="row">
            @if (isset($data))
                @foreach ($data as $item)
                    <div class="col-12 col-sm-6 col-md-4 d-flex">
                        <a class="d-flex text-black w-100"
                            href="{{ route('books.search.show', [$item['id'], $item['volumeInfo']['title']]) }}">
                            <div class="card shadow rounded mb-4 flex-1">
                                <div class="card-body text-center text-lg-left">
                                    @isset($item['volumeInfo']['imageLinks']['thumbnail'])
                                        <div class="text-center">
                                            <img src="{{ $item['volumeInfo']['imageLinks']['thumbnail'] }}"
                                                class="mb-3 rounded img-fluid">
                                        </div>
                                    @endisset
                                    <div class="d-flex align-items-center mb-2">
                                        @isset($item['volumeInfo']['averageRating'])
                                            <p class="text-gray-3 mr-3">
                                                {{ $item['volumeInfo']['averageRating'] }}/5
                                            </p>
                                        @endisset
                                        @isset($item['volumeInfo']['categories'])

                                            @foreach ($item['volumeInfo']['categories'] as $category)
                                                <div class="text-center text-md-left w-100">
                                                    <span
                                                        class="badge badge-pill badge-primary align-self-center">{{ $category }}</span>

                                                </div>

                                            @endforeach
                                        @endisset
                                    </div>
                                    <h5 class="text-primary-500 mb-2"> {{ $item['volumeInfo']['title'] }}</h5>
                                    @if (isset($item['volumeInfo']['authors']))
                                        <h6 class="font-light mb-3"> {{ implode('  ', $item['volumeInfo']['authors']) }}
                                        </h6>
                                    @else
                                        Not found
                                    @endif


                                    <div class="bg-white mt-auto text-center text-lg-left">
                                        @if (isset($item['volumeInfo']['publishedDate']))
                                            <p class="text-gray-3">
                                                {{ date('d-m-Y', strtotime($item['volumeInfo']['publishedDate'])) }} </p>
                                        @else
                                            Not found
                                        @endif
                                        </p>
                                    </div>
                                    {{-- Button --}}
                                    @if (Auth::user()->hasRole('admin'))
                                        <div>
                                            @if (App\Models\Book::where('title', '=', $item['volumeInfo']['title'])->exists())
                                                <form action="{{ route('books.destroy', $item['volumeInfo']['title']) }}"
                                                    method="POST">
                                                    <input type="hidden" value="DELETE" name="_method">
                                                    @csrf
                                                    <button class="btn my-btn my-btn-small my-btn-danger mt-4 mb-4 w-100"
                                                        type="submit"><i class="fas fa-minus-circle mr-2"></i> Remove
                                                        book</button>
                                                </form>
                                            @else
                                                <form
                                                    action="{{ route('admin.books.add', $item['volumeInfo']['title']) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn my-btn my-btn-small my-btn-primary mt-4 mb-4 w-100"
                                                        type="submit"><i class="fas fa-bookmark mr-2"></i> Save
                                                        book</button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
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
