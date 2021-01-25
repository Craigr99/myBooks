@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.user.sidebar')
            <div class="col col-sm-8 col-lg-9 col-xl-10">
                <x-flash-message />
                @include('inc.navbar')
                <div class="row">
                    <div class="col col-lg-10 mt-5 position-relative">
                        <main class="card rounded">
                            {{-- Header image --}}
                            @if ($user->header_image !== 'default_header.png')
                                <img class="profile-header rounded-top image-fill"
                                    src="{{ asset('storage/images/' . $user->header_image) }}" height="300px">
                            @else
                                <img class="profile-header rounded-top image-fill" src="{{ asset('img/header.jpg') }}"
                                    height="300px">
                            @endif
                            {{-- Profile image --}}
                            @if ($user->image !== 'default.png')
                                <img src="{{ asset('storage/images/' . $user->image) }}"
                                    class="profile-img rounded-circle image-fill" />
                            @else
                                <img src="{{ asset('img/default.png') }}"
                                    class="profile-img rounded-circle image-fill border" />
                            @endif

                            {{-- Card body --}}
                            <div class="card-body">
                                <div class="row">
                                    <div
                                        class="col col-md-10 col-lg-12 col-xl-9 offset-md-2 offset-lg-0 offset-xl-2 pl-md-5 mt-5 mt-xl-0">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="flex-1">
                                                <h5>{{ $user->f_name }} {{ $user->l_name }}</h5>
                                                <div class="d-flex">
                                                    <p class="text-gray-4">@</p>
                                                    <p class="text-gray-4">
                                                        {{ $user->username }}
                                                    </p>
                                                </div>
                                                <a class="bio w-75 text-accent-100 d-lg-none" data-toggle="collapse"
                                                    href="#bioCollapse" role="button" aria-expanded="false"
                                                    aria-controls="bioCollapse">
                                                    <p>About me..</p>
                                                </a>
                                                <div class="collapse mb-3 d-lg-block" id="bioCollapse">
                                                    <p class="mt-lg-2">
                                                        {{ $user->bio }}
                                                    </p>
                                                </div>
                                                <div class="followers d-flex text-gray-2">
                                                    <p class="mr-3">Followers:
                                                        <b>{{ $user->followers() }}</b>
                                                    </p>
                                                    <p>Following: <b>{{ $user->follows->count() }}</b></p>
                                                </div>
                                                <p class="text-gray-2 mt-2">Member since: <br class="d-sm-none" />
                                                    <b>{{ date('d-m-Y', strtotime($user->created_at)) }}</b>
                                                </p>
                                            </div>
                                            <div>
                                                @if ($user->id == Auth::user()->id)
                                                    <a class="btn my-btn my-btn-outline my-btn-small d-md-none"
                                                        href="{{ route('user.profile.edit', Auth::user()->id) }}">Edit
                                                        profile</a>
                                                    <a class="btn my-btn my-btn-outline d-none d-md-block"
                                                        href="{{ route('user.profile.edit', Auth::user()->id) }}">Edit
                                                        profile</a>

                                                @else
                                                    <form action="{{ route('user.profile.store', $user->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button class="btn my-btn my-btn-outline"
                                                            type="submit">{{ Auth::user()->isFollowing($user) ? 'Unfollow' : 'Follow' }}</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <section class="posts">
                                    {{-- Profile Blogs & Reviews
                                    --}}
                                    <div class="d-flex">
                                        <a href="{{ route('user.profile.index', $user->id) }}"
                                            class="btn w-100 btn-link border-right border-top">Reviews</a>
                                        <button class="btn w-100 btn-link border-top border-primary">Blogs</button>
                                    </div>

                                    <div class="border-bottom border-top mt-5 py-4">
                                        <div class="d-flex justify-content-between align-items-center px-4">
                                            <h5>Blog posts</h5>
                                            @if ($user->id == Auth::user()->id)
                                                <a href="{{ route('user.blogs.create') }}"
                                                    class="btn my-btn my-btn-outline">New
                                                    Blog</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        @if (count($user->blogs) === 0)
                                            <h4 class="p-4">No blogs found.</h4>
                                        @endif
                                        @foreach ($user->blogs as $blog)
                                            <div class="d-flex border-bottom py-4">
                                                <div class="mr-4">
                                                    {{-- Profile image
                                                    --}}
                                                    @if ($user->image !== 'default.png')
                                                        <img src="{{ asset('storage/images/' . $user->image) }}"
                                                            class="rounded-circle image-fill" height="70px" width="70px" />
                                                    @else
                                                        <img src="{{ asset('img/default.png') }}"
                                                            class="rounded-circle image-fill border" height="70px"
                                                            width="70px" />
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="text-gray-4 mb-2">{{ $blog->created_at->diffForHumans() }}
                                                    </h6>
                                                    <h5>{{ $blog->title }}</h5>
                                                    <p class="mt-2 mb-3">{{ $blog->subtitle }}</p>
                                                    <p> {{ Str::limit($blog->body, 140) }}</p>
                                                    <a href="#" class="btn-link text-primary-600 mt-3">Read
                                                        more</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            </div>
                        </main>
                    </div>
                    {{-- Following bar --}}
                    <div class="col-lg-2 mt-5 d-none d-lg-block">
                        <aside class="following">
                            <div class="card rounded">
                                <div class="header">
                                    <p class="font-medium m-0">Following</p>
                                </div>
                                <div class="card-body">
                                    @foreach (Auth::user()->follows as $user)
                                        <div class="d-flex align-items-center mb-3">
                                            @if ($user->image !== 'default.png')
                                                <img class="border rounded-circle image-fill" width="40px" height="40px"
                                                    src="{{ asset('storage/images/' . $user->image) }}" alt="Profile image">
                                            @else
                                                <img class="border rounded-circle image-fill"
                                                    src="{{ asset('img/default.png') }}" width="40px" height="40px">
                                            @endif
                                            <a href="{{ route('user.profile.index', $user->id) }}">
                                                <p class="ml-3 m-0 text-black">{{ $user->f_name }} {{ $user->l_name }}</p>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
