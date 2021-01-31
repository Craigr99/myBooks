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
                                <div class="row">
                                    <div class="col-12 col-lg-8">
                                        {{-- Review body left --}}
                                        <section>
                                            <a href="{{ route('books.search.show', $review->book->id) }}">
                                                <img src="{{ $review->book->image }}"
                                                    class="d-lg-none rounded img-fluid mb-3" width="140px">
                                            </a>
                                            <div class="d-flex justify-content-between mb-3">
                                                <h4>
                                                    <a href="{{ route('books.search.show', $review->book->id) }}"
                                                        class="text-gray-1">
                                                        {{ $review->book->title }}
                                                    </a>
                                                </h4>
                                                <h4>9.1</h4>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <small class="text-gray-3 mr-2">by
                                                    <a href="{{ route('user.profile.index', $review->user->id) }}">
                                                        {{ $review->user->f_name }}
                                                        {{ $review->user->l_name }}
                                                    </a>
                                                </small>

                                                {{-- Profile image --}}
                                                @if ($review->user->image !== 'default.png')
                                                    <img src="{{ asset('storage/images/' . $review->user->image) }}"
                                                        class="rounded-circle image-fill" height="26px" width="26px" />
                                                @else
                                                    <img src="{{ asset('img/default.png') }}"
                                                        class="rounded-circle image-fill border" height="26px"
                                                        width="26px" />
                                                @endif
                                            </div>
                                            <div class="mt-5">
                                                <h5 class="text-primary-600 mb-2">{{ $review->title }}</h5>
                                                <p>{{ $review->body }}</p>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-2 col-lg-4 d-flex justify-content-center">
                                        <a href="{{ route('books.search.show', $review->book->id) }}">
                                            <img src="{{ $review->book->image }}"
                                                class="rounded img-fluid d-none d-lg-block" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
