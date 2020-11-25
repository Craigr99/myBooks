<div class="col-sm-4 col-lg-3 col-xl-2 d-none d-md-block">
    <nav class="vh-80">
        <div class="text-center mb-5">
            @if (Auth::user()->image !== 'default.png')
                <img src="{{ asset('storage/images/' . Auth::user()->image) }}" class="rounded-circle mr-1 image-fill"
                    height="160px" width="160px" />
            @else
                <img src="{{ asset('img/default.png') }}" class="rounded-circle mr-1 image-fill" height="50%"
                    width="50%" />
            @endif
        </div>
        <ul class="nav-list list-group px-3">

            <li class="list-item my-2 {{ Request::is('user/home') ? 'active' : '' }}">
                <a href="{{ route('user.home') }}" class="btn my-btn btn-block"><span
                        class="fas fa-home mr-4"></span>Home</a>
            </li>
            <li class="list-item my-2 {{ Request::is('user/profile') ? 'active' : '' }}">
                <a href="{{ route('user.profile') }}" class="btn my-btn btn-block"><span
                        class="fas fa-user mr-4"></span>Profile</a>
            </li>
            <li class="list-item my-2">
                <a href="#" class="btn my-btn btn-block"><span class="fas fa-users mr-4"></span>Following</a>
            </li>
        </ul>

        <ul class="nav-list list-group mt-5 px-3">
            <p class="text-sm text-gray-4 ml-3">YOUR BOOKS</p>

            <li class="list-item my-2 {{ Request::is(['user/books']) ? 'active' : '' }}">
                <a href="{{ route('user.books.index') }}" class="btn my-btn btn-block"><span
                        class="fas fa-book mr-4"></span>Saved books</a>
            </li>

        </ul>
    </nav>
</div>
