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
                            @if (Auth::user()->header_image !== 'default_header.png')
                                <img class="profile-header rounded-top image-fill"
                                    src="{{ asset('storage/images/' . Auth::user()->header_image) }}" height="300px">
                            @else
                                <img class="profile-header rounded-top image-fill" src="{{ asset('img/header.jpg') }}"
                                    height="300px">
                            @endif
                            {{-- Profile image --}}
                            @if (Auth::user()->image !== 'default.png')
                                <img src="{{ asset('storage/images/' . Auth::user()->image) }}"
                                    class="profile-img rounded-circle image-fill" />
                            @else
                                <img src="{{ asset('img/default.png') }}"
                                    class="profile-img rounded-circle image-fill border" />
                            @endif

                            {{-- Card body --}}
                            <div class="card-body vh-100">
                                <div class="row border-bottom">
                                    <div
                                        class="col col-md-10 col-lg-12 col-xl-9 offset-md-2 offset-lg-0 offset-xl-2 pl-md-5 mt-5 mt-xl-0">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="flex-1">
                                                <h5>{{ Auth::user()->f_name }} {{ Auth::user()->l_name }}</h5>
                                                <div class="d-flex">
                                                    <p class="text-gray-4">@</p>
                                                    <p class="text-gray-4">
                                                        {{ Auth::user()->username }}
                                                    </p>
                                                </div>
                                                <a class="bio w-75 text-accent-100 d-lg-none" data-toggle="collapse"
                                                    href="#bioCollapse" role="button" aria-expanded="false"
                                                    aria-controls="bioCollapse">
                                                    <p>About me..</p>
                                                </a>
                                                <div class="collapse mb-3 d-lg-block" id="bioCollapse">
                                                    <p class="mt-lg-2">
                                                        {{ Auth::user()->bio }}
                                                    </p>
                                                </div>
                                                <div class="followers d-flex text-gray-3">
                                                    <p class="mr-3">Followers: <b>122</b></p>
                                                    <p>Following: <b>1222</b></p>
                                                </div>
                                                <p class="text-gray-3">Member since: <br class="d-sm-none" />
                                                    <b>{{ date('d-m-Y', strtotime(Auth::user()->created_at)) }}</b>
                                                </p>
                                            </div>
                                            <div>
                                                <a class="btn my-btn my-btn-outline my-btn-small d-md-none"
                                                    href="{{ route('user.profile.edit') }}">Edit
                                                    profile</a>
                                                <a class="btn my-btn my-btn-outline d-none d-md-block"
                                                    href="{{ route('user.profile.edit') }}">Edit
                                                    profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Profile Blogs & Reviews
                                --}}
                                <div class="d-flex">
                                    <button class="btn w-100 btn-link border-right">Reviews</button>
                                    <button class="btn w-100 btn-link">Blogs</button>
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
                                    @for ($i = 0; $i < 4; $i++)
                                        <div class="d-flex align-items-center mb-3">
                                            <img class="border rounded-circle image-fill" width="40px" height="40px"
                                                src="{{ asset('img/default.png') }}" alt="Profile image">
                                            <p class="ml-3 m-0">Test name</p>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
