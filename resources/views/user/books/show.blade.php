@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container">
        <div class="row">
            <h1>{{ $item['volumeInfo']['title'] }}</h1>
            <h4>by {{ implode('  ', $item['volumeInfo']['authors']) }}</h4>
            <img src="{{ $item['volumeInfo']['imageLinks']['thumbnail'] }}">
        </div>
    </div>
    </div>
@endsection
