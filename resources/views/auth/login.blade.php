@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex flex-column justify-content-center vh-100">
                <div class="card rounded">
                    <div class="row vh-80">
                        <div class="col-sm-6 col-md-6 p-5 d-none d-md-flex login-left-container flex-column"
                            style="background-image: url({{ asset('img/login_svg.svg') }})">
                            <h4>
                                <a class="text-white" href="{{ route('welcome') }}">myBooks</a>
                            </h4>

                            <div class="mt-auto">
                                <h4>Welcome</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet.</p>
                            </div>
                        </div>

                        <div class="col-md-6 px-md-5 px-lg-0">
                            <div class="d-flex align-items-center justify-content-center h-100 ">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <h4 class="text-purple">Log in</h4>
                                    <p class="mt-3 mb-4">Don’t have an account? <a href="{{ route('register') }}">Create one
                                            now</a></p>
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autofocus placeholder="Username">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <input id="password" type="password"
                                        class="form-control mt-2 @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    <div class="d-flex align-items-center mt-3 mb-3">
                                        <button type="submit" class="btn my-btn my-btn-primary mr-3">Login</button>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                Remember password
                                            </label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">
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
@endsection
