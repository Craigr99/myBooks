<div class="col-sm-4 col-lg-3 col-xl-2 d-none d-sm-block bg-white">
    <nav class="sidebar vh-100">
        <div class="text-center mb-5">
            @if (Auth::user()->image !== 'default.png')
                <img src="{{ asset('storage/images/' . Auth::user()->image) }}" class="rounded-circle image-fill"
                    height="160px" width="160px" />
            @else
                <img src="{{ asset('img/default.png') }}" class="rounded-circle image-fill border" height="50%"
                    width="50%" />
            @endif
        </div>
        <ul class="nav-list list-group px-3">

            <li class="list-item my-2 {{ Request::is('user/home') ? 'active' : '' }}">
                <a href="{{ route('user.home') }}" class="btn my-btn btn-block"><span
                        class="fas fa-home mr-4"></span>Home</a>
            </li>
            <li class="list-item my-2 {{ request()->is('user/profile*') ? 'active' : '' }}">
                <a href="{{ route('user.profile.index', Auth::user()->id) }}" class="btn my-btn btn-block"><span
                        class="fas fa-user mr-4"></span>Profile</a>
            </li>
            <li class="list-item my-2 {{ request()->is('user/following*') ? 'active' : '' }}">
                <a href="{{ route('user.profile.following.index', Auth::user()->id) }}"
                    class="btn my-btn btn-block"><span class="fas fa-users mr-4"></span>Following</a>
            </li>
            <li class="list-item my-2 {{ request()->is('user/*/reviews*') ? 'active' : '' }}">
                <a href="{{ route('user.profile.index', Auth::user()->id) }}" class="btn my-btn btn-block"><span
                        class="fas fa-pen-alt mr-4"></span>Reviews</a>
            </li>
            <li class="list-item my-2 {{ request()->is('user/*/blogs*') ? 'active' : '' }}">
                <a href="{{ route('user.blogs.index', Auth::user()->id) }}" class="btn my-btn btn-block"><span
                        class="fas fa-blog mr-4"></span>Blogs</a>
            </li>
        </ul>

        <ul class="nav-list list-group mt-5 px-3">
            <p class="text-sm text-gray-4 ml-3">YOUR BOOKS</p>

            <li class="list-item my-2 {{ Request::is(['user/books/reading']) ? 'active' : '' }}">
                <a href="{{ route('user.books.shelf.index', 'reading') }}" class="btn my-btn btn-block"><span
                        class="fas fa-book-open mr-4"></span>Reading</a>
            </li>

            <li class="list-item my-2 {{ Request::is(['user/books/later']) ? 'active' : '' }}">
                <a href="{{ route('user.books.shelf.index', 'later') }}" class="btn my-btn btn-block"><span
                        class="fas fa-clipboard-list mr-4"></span>Want to read</a>
            </li>

            <li class="list-item my-2 {{ Request::is(['user/books/finished']) ? 'active' : '' }}">
                <a href="{{ route('user.books.shelf.index', 'finished') }}" class="btn my-btn btn-block"><span
                        class="fas fa-check mr-4"></span>Finished reading</a>
            </li>
        </ul>
    </nav>
</div>
