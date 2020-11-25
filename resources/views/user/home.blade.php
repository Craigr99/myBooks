@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container-fluid">
        <div class="row mt-5">
            @include('inc.user.sidebar')
            <div class="col-sm-8 col-lg-9 col-xl-10">
                <main class="text-center text-lg-left">
                    <h3>Welcome back <span>{{ Auth::user()->f_name }}</span></h3>
                </main>
            </div>
        </div>
    </div>
@endsection
