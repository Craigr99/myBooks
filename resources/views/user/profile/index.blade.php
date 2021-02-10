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
                                <img class="profile-header rounded-top image-fill"
                                    src="{{ asset('img/default-header.jpg') }}" height="300px">
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
                                    {{-- Profile Blogs & Reviews --}}
                                    <div class="d-flex">
                                        <button
                                            class="btn w-100 btn-link border-right border-top border-primary">Reviews</button>
                                        <a href="{{ route('user.blogs.index', $user->id) }}"
                                            class="btn w-100 btn-link border-top">Blogs</a>
                                    </div>

                                    <div class="border-bottom border-top mt-5 py-4">
                                        <div class="d-flex justify-content-between align-items-center px-4">
                                            <h5>Book Reviews</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        @if (count($reviews) === 0)
                                            <h4 class="p-4">No reviews found.</h4>
                                        @endif
                                        @foreach ($reviews as $review)
                                            <div class="d-flex border-bottom py-4">
                                                <div class="mr-3 d-none d-md-block">
                                                    {{-- Profile image --}}
                                                    @if ($user->image !== 'default.png')
                                                        <img src="{{ asset('storage/images/' . $user->image) }}"
                                                            class="rounded-circle image-fill" height="70px" width="70px" />
                                                    @else
                                                        <img src="{{ asset('img/default.png') }}"
                                                            class="rounded-circle image-fill border" height="70px"
                                                            width="70px" />
                                                    @endif
                                                </div>
                                                <div class="d-flex">
                                                    <img src="{{ $review->book->image }}" class="rounded img-fluid mr-3"
                                                        width="80" />
                                                    <div class="flex-column">
                                                        <p class="text-gray-4 font-x-light mb-2">
                                                            {{ $review->created_at->diffForHumans() }}
                                                        </p>
                                                        <h5 class="mb-3">{{ $review->title }}</h5>
                                                        <p> {{ Str::limit($review->body, 140) }}</p>
                                                        <a href="{{ route('user.reviews.show', $review->id) }}"
                                                            class="btn-link text-primary-600 mt-3">Read
                                                            more</a>
                                                    </div>
                                                </div>
                                                @if ($review->user->id == Auth::user()->id)
                                                    <div class="ml-auto">
                                                        <form style="display: inline-block" method="POST"
                                                            action="{{ route('user.reviews.destroy', $review->id) }}">
                                                            <input type="hidden" value="DELETE" name="_method">
                                                            <input type="hidden" value="{{ csrf_token() }}"
                                                                name="_token">
                                                            <button type="submit" class="btn my-btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {!! $reviews->links('pagination::bootstrap-4') !!}
                                </div>
                            </div>
                        </main>
                    </div>
                    {{-- Following bar --}}
                    <div class="col-lg-2 mt-5 d-none d-lg-block">
                        <aside class="following">
                            <div class="card rounded">
                                <div class="header">
                                    <a href="{{ route('user.profile.following.index') }}"
                                        class="text-white text-r font-medium m-0">Following</a>
                                </div>
                                <div class="card-body">
                                    @forelse (Auth::user()->follows as $user)
                                        <div class="d-flex align-items-center mb-3">
                                            @if ($user->image !== 'default.png')
                                                <img class="border rounded-circle image-fill" width="40px" height="40px"
                                                    src="{{ asset('storage/images/' . $user->image) }}" alt="Profile image">
                                            @else
                                                <img class="border rounded-circle image-fill"
                                                    src="{{ asset('img/default.png') }}" width="40px" height="40px">
                                            @endif
                                            <a href="{{ route('user.profile.index', $user->id) }}">
                                                <p class="ml-3 m-0 text-black">{{ $user->f_name }} {{ $user->l_name }}
                                                </p>
                                            </a>
                                        </div>
                                    @empty
                                        <p>None found</p>
                                    @endforelse
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
