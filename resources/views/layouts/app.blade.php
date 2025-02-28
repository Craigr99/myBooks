<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'myBooks') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/observers.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4e942320f1.js" crossorigin="anonymous"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://drive.google.com/uc?id=1jLrfISsLUcRiwgNl0koSfsS6lylj0E7h">
</head>

<body>
    <div id="app">
        <main>
            @yield('content')
            @if (Request::is(['login', 'register']))

            @else
                {{-- @include('inc.footer') --}}
            @endif

        </main>
    </div>
</body>
<script>
    setTimeout(function() {
        $('.alert').alert('close')
    }, 3000)

</script>

</html>
