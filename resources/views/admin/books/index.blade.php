@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container-fluid">
        <div class="row mt-5 ">
            @include('inc.sidebar')
            <div class="col-sm-8 col-lg-9 col-xl-10">
                <main>
                    <div class="d-flex align-items-center">
                        <h4 class="mr-3"> Books</h4>
                        <a class="btn-link" href="{{ route('admin.books.create') }}">Add</a>
                    </div>

                    @if (count($books) === 0)
                        <h4>No Books found!</h4>
                    @else
                        <div class="table-responsive mt-5">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Publish date</th>
                                        <th scope="col">Publisher</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ Str::limit($book->description, 30) }}</td>
                                            <td>{{ $book->publish_date }}</td>
                                            <td>{{ $book->publisher->name }}</td>
                                            <td class="d-flex justify-content-lg-between">
                                                <a href="{{ route('admin.books.show', $book->id) }}">View</a>
                                                <a href="#">Edit</a>
                                                <form method="POST" action="{{ route('admin.books.destroy', $book->id) }}">
                                                    <input type="hidden" value="DELETE" name="_method">
                                                    @csrf
                                                    <input type="submit" value="Delete">
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
