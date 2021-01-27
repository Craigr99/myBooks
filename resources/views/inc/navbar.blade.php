<nav class="navbar navbar-expand-md navbar-light py-4">
    <a href="{{ route('homepage') }}">
        <h5 class="text-gray-1 mr-5">myBooks</h5>
    </a>
    @if (Auth::user()->hasRole('admin'))
        {{-- Search bar --}}
        <form action="{{ route('admin.books.search.index') }}" method="POST"
            class="form-inline my-2 my-lg-0 d-none d-sm-block">
            @csrf
            <input name="title" class="form-control" type="search" placeholder="Search books" aria-label="Search books">
            <button class="btn my-btn-outline rounded my-2 my-sm-0" type="submit">Search</button>
        </form>
    @endif

    <button class="navbar-toggler" type="button" data-toggle="dropdown" data-target="#navbarSupportedContent"
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
                    <a id="navbarDropdown" class="nav-link dropdown-toggle d-none d-sm-block" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{-- Check if user has image --}}
                        @if (Auth::user()->image !== 'default.png')
                            <img src="{{ asset('storage/images/' . Auth::user()->image) }}"
                                class="rounded-circle mr-1 image-fill" height="30px" width="30px" />
                        @else
                            <img src="{{ asset('img/default.png') }}" class="rounded-circle mr-1 image-fill" height="30px"
                                width="30px" />
                        @endif
                        {{ Auth::user()->f_name }}
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.home') }}">
                            <span class="fas fa-home mr-4 d-sm-none"></span> Dashboard
                        </a>
                        <a class="dropdown-item d-md-none" href="{{ route('user.profile.index', Auth::user()->id) }}">
                            <span class="fas fa-user mr-4"></span> Profile
                        </a>
                        @if (Auth::user()->hasRole('admin'))
                            <a class="dropdown-item d-md-none" href="{{ route('admin.books.index') }}">
                                Books
                            </a>
                            <a class="dropdown-item d-md-none" href="{{ route('admin.users.index') }}">
                                Users
                            </a>
                        @endif
                        @if (Auth::user()->hasRole('user'))
                            <a class="dropdown-item d-md-none" href="#">
                                <span class="fas fa-pen-alt mr-4"></span> Blogs
                            </a>
                            <a class="dropdown-item d-md-none" href="#">
                                <span class="fas fa-pen-alt mr-4"></span> Reviews
                            </a>
                            <a class="dropdown-item d-md-none" href="#">
                                <span class="fas fa-book-open mr-4"></span> Reading
                            </a>
                            <a class="dropdown-item d-md-none" href="#">
                                <span class="fas fa-clipboard-list mr-4"></span> Want to read
                            </a>
                            <a class="dropdown-item d-md-none" href="#">
                                <span class="fas fa-check mr-4"></span> Finished reading
                            </a>
                        @endif
                        <a class="dropdown-item bg-gray-7" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     document.getElementById('logout-form').submit();">
                            <span class="fas fa-sign-out-alt mr-4"></span>
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        @if (Auth::user()->hasRole('admin'))
            {{-- Search bar --}}
            <form action="{{ route('admin.books.search.index') }}" method="POST" class="form-inline my-lg-0 d-sm-none">
                @csrf
                <div class="d-flex align-items-center w-100">
                    <input name="title" class="form-control" type="search" placeholder="Search books"
                        aria-label="Search books">
                    <button class="btn btn-outline-success rounded my-2 my-sm-0" type="submit">Search</button>
                </div>
            </form>
        @endif
    </div>
</nav>
