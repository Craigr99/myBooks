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
                                    <div>
                                        @if ($blog->user->id == Auth::user()->id)
                                            <a class="btn my-btn my-btn-outline my-btn-small d-md-none"
                                                href="{{ route('user.blogs.edit', $blog->id) }}">Edit
                                                blog</a>
                                            <a class="btn my-btn my-btn-outline d-none d-md-inline-block"
                                                href="{{ route('user.blogs.edit', $blog->id) }}">Edit
                                                blog</a>

                                            <form style="display: inline-block" method="POST"
                                                action="{{ route('user.blogs.destroy', $blog->id) }}">
                                                <input type="hidden" value="DELETE" name="_method">
                                                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                                <button type="submit"
                                                    class="btn my-btn my-btn-danger my-btn-small d-md-none">Delete
                                                    blog</button>
                                                <button type="submit"
                                                    class="btn my-btn my-btn-danger d-none d-md-inline-block">Delete
                                                    blog</button>

                                            </form>
                                        @endif
                                    </div>
                                    <h2 class="text-center mt-4">{{ $blog->title }}</h2>
                                    <p>{{ $blog->subtitle }}</p>

                                    <p class="font-weight-bold mt-5">
                                        <a href="{{ route('user.profile.index', $blog->user->id) }}">
                                            {{ $blog->user->f_name }}
                                        </a>
                                    </p>
                                    <p class="text-gray-3">{{ $blog->updated_at->diffForHumans() }}</p>
                                </header>

                                <section class="text-center">
                                    {{-- User image --}}
                                    @if (Auth::user()->image !== 'default.png')
                                        <a href="{{ route('user.profile.index', $blog->user->id) }}">
                                            <img src="{{ asset('storage/images/' . Auth::user()->image) }}"
                                                class="rounded-circle image-fill" height="160px" width="160px" />
                                        </a>
                                    @else
                                        <a href="{{ route('user.profile.index', $blog->user->id) }}">
                                            <img src="{{ asset('img/default.png') }}"
                                                class="rounded-circle image-fill border" height="50" width="50" />
                                        </a>
                                    @endif

                                    {{-- Blog image --}}
                                    @if ($blog->image)
                                        <img src="{{ asset('storage/images/' . $blog->image) }}" class=" image-fill mt-4"
                                            height="500px" width="100%" />
                                    @endif
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
