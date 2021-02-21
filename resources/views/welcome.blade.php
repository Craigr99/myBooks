@extends('layouts.app')

@section('content')
    <header class="container-fluid hero overflow-hidden">
        <div class="hero_img" style="background: url({{ asset('img/login_svg.svg') }})">
        </div>
        <div class="container mt-5">
            <x-logo></x-logo>
            <div class="row hero_left vh-80">
                <div class="col">
                    <p class="caption text-muted mb-2">WELCOME TO MYBOOKS</p>
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
            <div class="row mt-5 spacer-bottom-lg fade-in">
                <div class="col d-lg-flex align-items-center ">
                    <img src="{{ asset('img/bookshelves.svg') }}" height="400px" width="450px" alt="">
                    <div class="ml-lg-5 p-lg-5">
                        <p class="fas fa-th-large text-primary-600 my-3"></p>
                        <h5 class="mb-3">Keep track of your books with Shelves</h5>
                        <p>Store books in one of the three bookshelves available: Reading, Want to read or Finished reading.
                            Keeps track of your reading and organise your books!
                        </p>
                    </div>
                </div>
            </div>
            <div class="row spacer-bottom-lg fade-in">
                <div class="col d-lg-flex flex-row-reverse align-items-center ">
                    <img src="{{ asset('img/book_reading.svg') }}" height="400px" width="450px" alt="">
                    <div class="pr-lg-5">
                        <p class="fas fa-th-large text-primary-600 my-3"></p>
                        <h5 class="mb-3">Review books</h5>
                        <p>Recently read a book and want to let everyone know your thoughts? You can write reviews on any
                            book on the
                            website and read other reviews, and interact with reviews.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row mt-5 spacer-bottom-lg fade-in">
                <div class="col d-lg-flex align-items-center ">
                    <img src="{{ asset('img/book-pile.svg') }}" height="400px" width="450px" alt="">
                    <div class="ml-lg-5 p-lg-5">
                        <p class="fas fa-th-large text-primary-600 my-3"></p>
                        <h5 class="mb-3">Hundreds of books to choose from</h5>
                        <p>Explore hundreds of books at the touch of your finger, thanks to Google books API integration,
                            simply make a search in the search bar and find hundreds of books.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        &copy; 2020 myBooks All rights reserved.
    </footer>
@endsection
