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
                                <input name="title" type="text"
                                    class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                    value="{{ old('title') }}" placeholder="Title">

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <textarea name="description"
                                    class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" cols="30"
                                    rows="10" placeholder="Description">{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input name="isbn" type="text"
                                    class="form-control {{ $errors->has('isbn') ? 'is-invalid' : '' }}"
                                    value="{{ old('isbn') }}" placeholder="ISBN">
                                @if ($errors->has('isbn'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('isbn') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input name="publish_date" type="date"
                                    class="form-control {{ $errors->has('publish_date') ? 'is-invalid' : '' }}"
                                    value="{{ old('publish_date') }}">
                                @if ($errors->has('publish_date'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('publish_date') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input name="page_count" type="text"
                                    class="form-control {{ $errors->has('page_count') ? 'is-invalid' : '' }}"
                                    value="{{ old('page_count') }}" placeholder="Page count">
                                @if ($errors->has('page_count'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('page_count') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input name="image" type="text"
                                    class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                    value="{{ old('image') }}" placeholder="Image">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('image') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select name="publisher_id"
                                    class="form-control {{ $errors->has('publisher_id') ? 'is-invalid' : '' }}"
                                    value="{{ old('publisher_id') }}">
                                    @foreach ($publishers as $publisher)
                                        <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('publisher_id'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('publisher_id') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <select multiple name="categories[]"
                                    class="form-control {{ $errors->has('categories') ? 'is-invalid' : '' }}">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>

                                    @endforeach
                                </select>
                                @if ($errors->has('categories'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('categories') }}
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn my-btn my-btn-primary">Add</button>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection
