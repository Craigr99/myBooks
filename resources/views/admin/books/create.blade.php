@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container-fluid">
        <div class="row mt-5 ">
            @include('inc.sidebar')
            <div class="col-sm-8 col-lg-9 col-xl-6 offset-xl-1">
                <main class="d-flex flex-column">
                    <div class="card rounded shadow p-5">
                        <h4>Add a new book</h4>
                        <form action="{{ route('admin.books.store') }}" method="POST" class="mt-5">
                            @csrf

                            <div class="form-group">
                                <input name="title" type="text" class="form-control" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control" cols="30" rows="10"
                                    placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <input name="isbn" type="text" class="form-control" placeholder="ISBN">
                            </div>
                            <div class="form-group">
                                <input name="publish_date" type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <input name="page_count" type="text" class="form-control" placeholder="Page count">
                            </div>
                            <div class="form-group">
                                <input name="image" type="text" class="form-control" placeholder="Image">
                            </div>
                            <div class="form-group">
                                <select name="publisher" class="form-control">
                                    @foreach ($publishers as $publisher)
                                        <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select multiple name="categories[]" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn my-btn my-btn-primary">Add</button>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection
