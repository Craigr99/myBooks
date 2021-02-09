    <nav class="bg-gray-6">
        <div class="container d-flex justify-content-around justify-content-md-between align-items-center">
            {{-- Nav for mobile --}}
            <ul class="py-3 px-2 d-flex d-md-none w-100">
                <li>
                    <div class="dropdown">
                        <a href="#" class="text-primary-500" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <p>Book Categories <small class="fas fa-chevron-down"></small></p>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($categories->all() as $category)
                                <a href="{{ route('categories.books.index', $category->id) }}"
                                    class="dropdown-item text-primary-500">
                                    <p>{{ $category->name }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>

            {{-- Nav for md screens and larger --}}
            <ul class="py-3 px-2 d-none d-md-flex w-100 justify-content-between">
                @foreach ($categories->slice(0, 5) as $category)
                    <li>
                        <a href="{{ route('categories.books.index', $category->id) }}" class="text-primary-500">
                            <p>{{ $category->name }}</p>
                        </a>
                    </li>
                @endforeach
                @if (count($categories) > 5)
                    <li>
                        <div class="dropdown">
                            <a href="#" class="text-primary-500" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <p>Other Categories <small class="fas fa-chevron-down"></small></p>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach ($categories->slice(5)->all() as $category)
                                    <a href="{{ route('categories.books.index', $category->id) }}"
                                        class="dropdown-item text-primary-500">
                                        <p>{{ $category->name }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
