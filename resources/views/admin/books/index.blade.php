@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.admin.sidebar')

            <div class="col-sm-8 col-lg-9 col-xl-10">
                <x-flash-message />
                @include('inc.navbar')
                <div class="col mt-5">
                    <main>
                        <div class="d-flex align-items-center">
                            <h4 class="mr-3">Books</h4>
                            <a class="btn-link" href="{{ route('admin.books.create') }}">+ Add</a>
                        </div>

                        @if (count($books) === 0)
                            <h4>No Books found!</h4>
                        @else
                            <div class="table-responsive mt-3">
                                <table class="table table-hover">
                                    <thead class="bg-primary-700 text-white">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Author(s)</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Publish date</th>
                                            <th scope="col">Publisher</th>
                                            <th scope="col">Categories</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($books as $book)
                                            <tr class="table-light">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $book->id }}</td>
                                                <td>{{ $book->title }}</td>
                                                <td>
                                                    @foreach ($book->authors as $author)
                                                        <span class="d-block"> {{ $author->name }}</span>
                                                    @endforeach
                                                </td>

                                                <td>{{ Str::limit($book->description, 30) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($book->publish_date)) }}</td>
                                                <td>{{ $book->publisher->name }}</td>
                                                <td>
                                                    @foreach ($book->categories as $category)
                                                        <span class="d-block"> {{ $category->name }} </span>
                                                    @endforeach
                                                </td>
                                                <td class="d-flex flex-column justify-content-lg-between">
                                                    <a href="{{ route('admin.books.show', $book->id) }}">View</a>
                                                    <a href="{{ route('admin.books.edit', $book->id) }}">Edit</a>
                                                    {{-- <a href="#" data-toggle="modal" data-target="#delete-modal">Delete</a> --}}
                                                    <form style="display: inline-block" method="POST"
                                                        action="{{ route('admin.books.destroy', $book->id) }}">
                                                        <input type="hidden" value="DELETE" name="_method">
                                                        @csrf
                                                        <button type="submit" class="input-delete">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            {{-- <x-flash-modal :id="$book->id" /> --}}
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {!! $books->links('pagination::bootstrap-4') !!}
                                </div>
                            </div>
                        @endif
                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection
