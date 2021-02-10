@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex flex-column justify-content-center vh-100">
                <div class="card rounded-lg shadow">
                    <div class="row vh-80">
                        <div class="col-sm-6 col-md-6 p-5 d-none d-md-flex login-left-container shadow flex-column"
                            style="background-image: url({{ asset('img/login-img.svg') }})">
                            {{-- logo --}}
                            <a href="{{ route('welcome') }}">
                                <h5 class="text-white mr-5 d-flex align-items-center">
                                    <span class="fas fa-book-open mr-3 text-primary-300"></span> myBooks
                                </h5>
                            </a>

                            <div class="mt-auto">
                                <h4>Welcome back!</h4>
                                <p>Login with your myBooks account to start exploring books</p>
                            </div>
                        </div>

                        <div class="col-md-6 px-5 px-lg-0">
                            <div class="d-flex flex-column h-100 align-items-center justify-content-center">
                                <a href="{{ route('welcome') }}" class="align-self-start pt-5 px-5 d-md-none">
                                    <small class="text-accent-300 ml-4"><span class="fas fa-long-arrow-alt-left"></span>
                                        back home</small>
                                </a>
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <h4 class="text-primary-500">Log in</h4>
                                        <p class="my-4">Don’t have an account? <a href="{{ route('register') }}"
                                                class="text-primary-500">Create one
                                                now</a></p>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autofocus placeholder="Email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <input id="password" type="password"
                                            class="form-control mt-3 @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password" placeholder="Password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <div class="d-flex align-items-center mt-4 mb-3">
                                            <button type="submit" class="btn my-btn my-btn-primary mr-3">Login</button>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label text-sm" for="remember">
                                                    Remember password
                                                </label>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-primary-500">
                                                    Forgot your password?
                                                </a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
