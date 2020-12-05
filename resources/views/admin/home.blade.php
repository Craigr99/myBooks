@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.admin.sidebar')
            <div class="col-sm-8 col-lg-9 col-xl-10">
                @include('inc.navbar')
                <main class="text-center text-lg-left mt-5 px-3 vh-100">
                    <h3>Welcome back <span>{{ Auth::user()->f_name }}</span></h3>
                </main>
            </div>
        </div>
    </div>
@endsection
