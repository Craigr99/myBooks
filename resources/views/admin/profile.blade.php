@extends('layouts.app')
@section('content')
    @include('inc.navbar')
    <div class="container-fluid">
        <div class="row mt-5">
            @include('inc.sidebar')
            <div class="col-sm-8 col-lg-9 col-xl-10">
                <main class="">
                    <h3 class="text-center">Edit Profile</h3>
                    <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                value="{{ old('name') ?: Auth::user()->name }}" placeholder="Enter Name">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    {{ $errors->first('name') }}
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
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
                </main>
            </div>
        </div>
    </div>

@endsection
