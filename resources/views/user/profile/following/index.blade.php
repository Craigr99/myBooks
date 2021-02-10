@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.user.sidebar')
            <div class="col">
                <x-flash-message />
                @include('inc.navbar')
                <div class="row">
                    <div class="col col-xl-8 offset-xl-2 mt-5">
                        <main class="card rounded">
                            <div class="header w-100">
                                <h5>Following</h5>
                            </div>
                            <div class="p-4">
                                <div class="row">
                                    @forelse (Auth::user()->follows as $user)
                                        <div class="col col-lg-6 mb-3">
                                            <a href="{{ route('user.profile.index', $user->id) }}">
                                                <div class="d-flex">
                                                    <div class="mr-3">
                                                        @if ($user->image !== 'default.png')
                                                            <img class="border rounded-circle image-fill" width="60px"
                                                                height="60px"
                                                                src="{{ asset('storage/images/' . $user->image) }}"
                                                                alt="Profile image">
                                                        @else
                                                            <img class="border rounded-circle image-fill"
                                                                src="{{ asset('img/default.png') }}" width="60px"
                                                                height="60px">
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex">
                                                            <p class="text-gray-4">@</p>
                                                            <p class="text-gray-4">
                                                                {{ $user->username }}
                                                            </p>
                                                        </div>
                                                        <h6>{{ $user->f_name }} {{ $user->l_name }}</h6>
                                                    </div>
                                                    <form action="{{ route('user.profile.store', $user->id) }}" method="POST"
                                                        class="ml-auto">
                                                        @csrf
                                                        <button class="btn my-btn my-btn-small my-btn-outline"
                                                            type="submit">{{ Auth::user()->isFollowing($user) ? 'Unfollow' : 'Follow' }}</button>
                                                    </form>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <p>You are not following any users. </p>
                                    @endforelse
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
