@extends('layouts.app')

@section('content')
    {{-- @include('inc.navbar') --}}

    <header class="container-fluid hero overflow-hidden">
        <div class="hero_img" style="background: url({{ asset('img/login_svg.svg') }}); background-size:50%">
        </div>
        <div class=" container">
            <h5 class="py-5">myBooks</h5>

            <div class="row hero_left">
                <div class="col">
                    <p class="caption text-muted">WELCOME TO MYBOOKS</p>
                    <h5>A new way to explore books <br />
                        Read reviews, write reviews and meet new people</h5>

                    <div class="line my-5"></div>

                    <div class="buttons">
                        <a href="{{ route('register') }}" class="btn my-btn my-btn-primary mr-3">Sign up</a>
                        <a href="{{ route('login') }}" class="btn my-btn my-btn-outline">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col d-md-flex align-items-center ">
                    <img src="{{ asset('img/bookshelves.svg') }}" height="400px" width="450px" alt="">
                    <div class="ml-md-5 p-md-5">
                        <h5>This is a feature </h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam venenatis odio vel sollicitudin
                            consequat. Suspendisse placerat eu ipsum consequat mollis.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col d-md-flex flex-row-reverse align-items-center ">
                    <img src="{{ asset('img/bookshelves.svg') }}" height="400px" width="450px" alt="">
                    <div class="pr-5">
                        <h5>This is a feature </h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam venenatis odio vel sollicitudin
                            consequat. Suspendisse placerat eu ipsum consequat mollis.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>


    @include('inc.footer')

@endsection
