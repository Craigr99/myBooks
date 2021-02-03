    <nav class="bg-gray-6">
        <div class="container d-flex justify-content-around justify-content-md-between align-items-center">
            <ul class="py-3 px-2 d-flex w-100 justify-content-between">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('categories.books.index', $category->id) }}" class="text-primary-500">
                            <p>{{ $category->name }}</p>
                        </a>
                    </li>

                @endforeach
            </ul>
        </div>
    </nav>
