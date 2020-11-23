<nav class="navbar navbar-expand-md navbar-light bg-white py-4">
    <div class="container">
        <a class="navbar-brand" href="{{ Auth::user() ? url('/homepage') : url('/') }}">
            {{ config('app.name', 'myBooks') }}
        </a>
        {{-- Search bar --}}
        <form action="{{ route('books.index') }}" method="POST" class="form-inline my-2 my-lg-0">
            @csrf
            <input name="title" class="form-control mr-sm-2" type="search" placeholder="Search books"
                aria-label="Search books">
            <button class="btn btn-outline-success rounded my-2 my-sm-0" type="submit">Search</button>
        </form>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{-- Check if user has image --}}
                            @if (Auth::user()->image !== 'default.png')
                                <img src="{{ asset('storage/images/' . Auth::user()->image) }}"
                                    class="rounded-circle mr-1 image-fill" height="30px" width="30px" />
                            @else
                                <img src="{{ asset('img/default.png') }}" class="rounded-circle mr-1 image-fill"
                                    height="30px" width="30px" />
                            @endif
                            {{ Auth::user()->f_name }}
                            <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.home') }}">
                                Dashboard
                            </a>
                            @if (Auth::user()->hasRole('admin'))

                                <a class="dropdown-item d-md-none" href="{{ route('admin.home') }}">
                                    Profile
                                </a>
                                <a class="dropdown-item d-md-none" href="{{ route('admin.home') }}">
                                    Books
                                </a>
                                <a class="dropdown-item d-md-none" href="{{ route('admin.home') }}">
                                    Categories
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
