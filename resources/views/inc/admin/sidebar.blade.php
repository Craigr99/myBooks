    <div class="col-sm-4 col-lg-3 col-xl-2 d-none d-sm-block bg-white">
        <div class="text-center py-4">
            <a href="{{ Auth::user() ? url('/homepage') : url('/') }}">
                <h4 class="text-gray-1">{{ config('app.name', 'myBooks') }}</h4>
            </a>
        </div>
        <nav class="vh-100 mt-5">
            <div class="text-center mb-5">
                @if (Auth::user()->image !== 'default.png')
                    <img src="{{ asset('storage/images/' . Auth::user()->image) }}"
                        class="rounded-circle mr-1 image-fill" height="160px" width="160px" />
                @else
                    <img src="{{ asset('img/default.png') }}" class="rounded-circle mr-1 image-fill" height="50%"
                        width="50%" />
                @endif
            </div>
            <ul class="nav-list list-group px-3">

                <li class="list-item my-2 {{ Request::is('admin/home') ? 'active' : '' }}">
                    <a href="{{ route('admin.home') }}" class="btn my-btn btn-block"><span
                            class="fas fa-home mr-4"></span>Home</a>
                </li>
                <li class="list-item my-2 {{ Request::is('admin/profile') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile') }}" class="btn my-btn btn-block"><span
                            class="fas fa-user mr-4"></span>Profile</a>
                </li>
                <li class="list-item my-2">
                    <a href="#" class="btn my-btn btn-block"><span class="fas fa-cogs mr-4"></span>Settings</a>
                </li>
            </ul>

            <ul class="nav-list list-group mt-5 px-3">
                <p class="text-sm text-gray-4 ml-3">TABLES</p>

                <li class="list-item my-2 {{ Request::is(['admin/books', 'admin/books/create']) ? 'active' : '' }}">
                    <a href="{{ route('admin.books.index') }}" class="btn my-btn btn-block"><span
                            class="fas fa-book mr-4"></span>Books</a>
                </li>
                <li class="list-item my-2 {{ Request::is(['admin/users']) ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="btn my-btn btn-block"><span
                            class="fas fa-users mr-4"></span>Users</a>
                </li>
                <li class="list-item my-2">
                    <a href="#" class="btn my-btn btn-block"><span class="fas fa-list mr-4"></span>Categories</a>
                </li>
                <li class="list-item my-2">
                    <a href="#" class="btn my-btn btn-block"><span class="fas fa-user-edit mr-4"></span>Authors</a>
                </li>
                <li class="list-item my-2">
                    <a href="#" class="btn my-btn btn-block"><span class="fas fa-user-tie mr-4"></span>Publishers</a>
                </li>
            </ul>
        </nav>
    </div>
