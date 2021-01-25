@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.user.sidebar')
            <div class="col col-sm-8 col-lg-9 col-xl-10">
                <x-flash-message />
                @include('inc.navbar')
                <div class="row">
                    <div class="col mt-5 position-relative">
                        <main class="card rounded">
                            <div class="card-body">
                                <header class="text-center mb-4">
                                    <div class="mb-4">
                                        <a href="#" class="badge badge-success">Our Story</a>
                                        <a href="#" class="badge badge-success">Book Talk</a>
                                    </div>
                                    <h2 class="text-center">{{ $blog->title }}</h2>
                                    <p>{{ $blog->subtitle }}</p>

                                    <p class="font-weight-bold mt-5">{{ $blog->user->f_name }}</p>
                                    <p class="text-gray-3">{{ $blog->created_at->diffForHumans() }}</p>
                                </header>

                                <section class="text-center">
                                    <img src="{{ asset('storage/images/' . Auth::user()->image) }}"
                                        class="rounded-circle image-fill" width="100px" height="100px" />
                                    <img src="{{ asset('img/header.jpg') }}" class=" image-fill" height="500px"
                                        width="100%" />
                                </section>

                                <section class="mt-5">
                                    <div class="container">
                                        <p>{{ $blog->body }}</p>
                                    </div>
                                </section>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
