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
                            <img class="profile-header rounded-top image-fill" src="{{ asset('img/header.jpg') }}"
                                height="300px">
                            @if (Auth::user()->image !== 'default.png')
                                <img src="{{ asset('storage/images/' . Auth::user()->image) }}"
                                    class="profile-img rounded-circle image-fill" />
                            @else
                                <img src="{{ asset('img/default.png') }}" class="profile-img rounded-circle image-fill" />
                            @endif
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
                                                <p class="bio w-75 text-gray-3 d-none d-xl-block">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus
                                                    quibusdam beatae et asperiores odio suscipit assumenda aperiam alias.
                                                    Adipisci, veritatis perspiciatis laudantium odit velit eaque eligendi
                                                    dolorem repudiandae similique debitis.
                                                </p>
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
                                {{-- Profile Blogs & Reviews --}}
                                <div class="d-flex">
                                    <button class="btn w-100 btn-link border-right">Blogs</button>
                                    <button class="btn w-100 btn-link">Reviews</button>
                                </div>
                        </main>
                    </div>
                    {{-- Following bar --}}
                    <div class="col-lg-2 mt-5">
                        <aside class="red">
                            s
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
