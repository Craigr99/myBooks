@extends('layouts.app')
@section('content')
    @include('inc.navbar')
    <nav class="bg-gray-6">
        <div class="container d-flex justify-content-between align-items-center">
            <ul class="py-3 d-flex w-75 justify-content-between">
                <li>
                    <a href="#" class="text-purple">
                        <h6>Action</h6>
                    </a>
                </li>
                <li>
                <li>
                    <a href="#" class="text-purple">
                        <h6>Action</h6>
                    </a>
                </li>
                <li>
                <li>
                    <a href="#" class="text-purple">
                        <h6>Action</h6>
                    </a>
                </li>
                <li>
                <li>
                    <a href="#" class="text-purple">
                        <h6>Action</h6>
                    </a>
                </li>
                <li>
                <li>
                    <a href="#" class="text-purple">
                        <h6>Action</h6>
                    </a>
                </li>
                <li>
            </ul>
            <ul class="d-flex justify-content-between">
                <li class="mr-5"><a href="#" class="text-purple">
                        <h6>Blog</h6>
                    </a></li>
                <li><a href="#" class="text-purple">
                        <h6>Discussion</h6>
                    </a></li>
            </ul>
        </div>
    </nav>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1488190211105-8b0e65b80b4e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&h=600&q=80"
                    class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container">
        <h1>Home page</h1>
    </div>



    @include('inc.footer')

@endsection
