@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.admin.sidebar')
            <div class="col">
                @include('inc.navbar')
                <div class="col-sm col-lg-10 offset-lg-1 col-xl-6 offset-xl-3 mt-5">
                    <main>
                        <div class="card rounded shadow">
                            <div class="p-4 rounded-top bg-primary-700 text-white">
                                <h4> {{ $book->title }}</h4>
                            </div>

                            <div class="card-body">
                                <table class="mt-3 table table-hover">
                                    <tbody>
                                        <tr>
                                            <img src="{{ $book->image }}" class="rounded" alt="">
                                        </tr>
                                        <tr>
                                            <td>Title</td>
                                            <td>{{ $book->title }}</td>
                                        </tr>
                                        <tr>
                                            <td>Author(s)</td>
                                            <td>
                                                @foreach ($book->authors as $author)
                                                    <span class="d-block"> {{ $author->name }}</span>
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
                                <a href="{{ route('admin.books.edit', $book->id) }}"
                                    class="btn my-btn my-btn-outline">Edit</a>
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
    </div>
@endsection
