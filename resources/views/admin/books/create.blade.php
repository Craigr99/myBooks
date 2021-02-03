@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.admin.sidebar')
            <div class="col">
                @include('inc.navbar')
                <div class="col col-xl-8 offset-xl-2 mt-5">
                    <main class="d-flex flex-column">
                        <div class="card rounded p-5">
                            {{-- Search bar --}}
                            <form action="{{ route('admin.books.search.index') }}" method="POST"
                                class="form-inline my-2 my-lg-0 d-none d-sm-block">
                                @csrf
                                <input name="title" class="form-control mr-sm-2" type="search" placeholder="Search books"
                                    aria-label="Search books">
                                <button class="btn btn-outline-success rounded my-2 my-sm-0" type="submit">Search</button>
                            </form>
                            <h4 class="mt-3">Add a new book</h4>
                            <form action="{{ route('admin.books.store') }}" method="POST" class="mt-5"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title</label>
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
                                    <label for="author">Authors</label>
                                    <select multiple name="authors[]" id="author"
                                        class="form-control {{ $errors->has('authors') ? 'is-invalid' : '' }}">
                                        @foreach ($authors as $author)
                                            <option value="{{ $author->id }}"
                                                {{ in_array($author->id, old('authors') ?: []) ? 'selected' : '' }}>
                                                {{ $author->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('categories'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('categories') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description"
                                        class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                        cols="30" rows="10" placeholder="Description">{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('description') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="isnb">ISBN</label>
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
                                    <label for="publish_date">Publish date</label>
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
                                    <label for="page_count">Page count</label>
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
                                    <div class="custom-file">
                                        <input type="file" name="image"
                                            class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                            id="image">
                                        <label class="custom-file-label" for="image">Book Cover</label>
                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback">
                                                {{ $errors->first('image') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="publisher">Publisher</label>
                                    <select name="publisher_id"
                                        class="form-control {{ $errors->has('publisher_id') ? 'is-invalid' : '' }}">
                                        @foreach ($publishers as $publisher)
                                            <option value="{{ $publisher->id }}"
                                                {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                                                {{ $publisher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('publisher_id'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('publisher_id') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="category">Categories</label>
                                    <select multiple name="categories[]" id="category"
                                        class="form-control {{ $errors->has('categories') ? 'is-invalid' : '' }}">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ in_array($category->id, old('categories') ?: []) ? 'selected' : '' }}>
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
    </div>
@endsection
