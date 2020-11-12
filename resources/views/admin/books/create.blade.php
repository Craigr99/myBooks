@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container-fluid">
        <div class="row mt-5 ">
            @include('inc.sidebar')
            <div class="col-sm-8 col-lg-9 col-xl-10">
                <main>
                    <form action="{{ route('admin.books.store') }}" method="POST">
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
                        <button type="submit" class="btn my-btn my-btn-primary">Add</button>
                    </form>
                </main>
            </div>
        </div>
    </div>
@endsection
