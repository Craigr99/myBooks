@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.user.sidebar')
            <div class="col">
                <x-flash-message />
                @include('inc.navbar')
                <div class="col col-xl-8 offset-xl-2 mt-5">
                    <main class="card card-body rounded">
                        <h4 class="my-4">Edit Profile</h4>
                        <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label for="f_name">First Name</label>
                                <input type="text" name="f_name" id="f_name"
                                    class="form-control {{ $errors->has('f_name') ? 'is-invalid' : '' }}"
                                    value="{{ old('f_name') ?: Auth::user()->f_name }}" placeholder="First Name">
                                @if ($errors->has('f_name'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('f_name') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="l_name">Surname</label>
                                <input type="text" name="l_name" id="l_name"
                                    class="form-control {{ $errors->has('l_name') ? 'is-invalid' : '' }}"
                                    value="{{ old('l_name') ?: Auth::user()->l_name }}" placeholder="Surname">
                                @if ($errors->has('l_name'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('l_name') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    value="{{ old('email') ?: Auth::user()->email }}" placeholder="Enter Email">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    placeholder="Enter Password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                            <div class="custom-file">
                                <input type="file" name="image"
                                    class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image">
                                <label class="custom-file-label" for="image">Profile Image</label>
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('image') }}
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn my-btn my-btn-primary mt-3">Update</button>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>

@endsection
