    <nav class="bg-gray-6">
        <div class="container d-flex justify-content-around justify-content-md-between align-items-center">
            <ul class="py-3 d-flex w-75 justify-content-between">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('categories.books.index', $category->id) }}" class="text-primary-500">
                            <p>{{ $category->name }}</p>
                        </a>
                    </li>

                @endforeach
            </ul>
            <ul class="d-none d-lg-flex justify-content-between">
                <li class="mr-5"><a href="#" class="text-primary-500">
                        <p>Blog</p>
                    </a></li>
                <li><a href="#" class="text-primary-500">
                        <p>Discussion</p>
                    </a></li>
            </ul>
        </div>
    </nav>
