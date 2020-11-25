@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container-fluid">
        <div class="row mt-5 ">
            @include('inc.admin.sidebar')
            <div class="col-sm col-md-8 col-lg-9 col-xl-8">
                <main>
                    <div class="d-flex align-items-center">
                        <h4 class="mr-3"> Books</h4>
                        <a class="btn-link" href="{{ route('admin.books.create') }}">Add</a>
                    </div>

                    @if (count($books) === 0)
                        <h4>No Books found!</h4>
                    @else
                        <div class="table-responsive mt-5">
                            <table class="table table-hover">
                                <thead class="purple-bg text-white">
                                    <tr>
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
                                        <tr>
                                            <td>{{ $book->title }}</td>
                                            <td>
                                                @foreach ($book->authors as $author)
                                                    <span class="d-block"> {{ $author->f_name }} {{ $author->l_name }}
                                                    </span>
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
                                            <td class="d-flex justify-content-lg-between">
                                                <a href="{{ route('admin.books.show', $book->id) }}">View</a>
                                                <a href="{{ route('admin.books.edit', $book->id) }}">Edit</a>
                                                <form method="POST" action="{{ route('admin.books.destroy', $book->id) }}">
                                                    <input type="hidden" value="DELETE" name="_method">
                                                    @csrf
                                                    <input class="input-delete" type="submit" value="Delete">
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    @endif
                </main>
            </div>
        </div>
    </div>
@endsection
