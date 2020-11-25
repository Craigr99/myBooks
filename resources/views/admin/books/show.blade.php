@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container-fluid">
        <div class="row mt-5">
            @include('inc.admin.sidebar')
            <div class="col-sm-8 col-lg-9 col-xl-5 offset-xl-2">
                <main>
                    <div class="card rounded shadow">
                        <div class="p-4 rounded-top purple-bg text-white">
                            <h4> {{ $book->title }}</h4>
                        </div>

                        <div class="card-body">
                            <img src="{{ asset('storage/images/' . $book->image) }}" alt="Book cover">
                            <table class="mt-3 table table-hover">
                                <tbody>
                                    <tr>
                                        <img src="{{ $book->image }}" alt="">
                                    </tr>
                                    <tr>
                                        <td>Title</td>
                                        <td>{{ $book->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>Author(s)</td>
                                        <td>
                                            @foreach ($book->authors as $author)
                                                <span class="d-block"> {{ $author->f_name }} {{ $author->l_name }}
                                                </span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Publisher</td>
                                        <td>{{ $book->publisher->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Publish Date</td>
                                        <td>{{ date('d-m-Y', strtotime($book->publish_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>ISBN</td>
                                        <td>{{ $book->isbn }}</td>
                                    </tr>
                                    <tr>
                                        <td>Page count</td>
                                        <td>{{ $book->page_count }}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{{ $book->description }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="{{ route('admin.books.index') }}" class="btn btn-link">Back</a>
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="btn my-btn my-btn-outline">Edit</a>
                            <form style="display: inline-block" method="POST"
                                action="{{ route('admin.books.destroy', $book->id) }}">
                                <input type="hidden" value="DELETE" name="_method">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                <button type="submit" class="btn my-btn btn-danger">Delete</button>

                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection
