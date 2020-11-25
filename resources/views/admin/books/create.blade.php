@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container-fluid">
        <div class="row mt-5 ">
            @include('inc.admin.sidebar')
            <div class="col-sm-8 col-lg-9 col-xl-6 offset-xl-1">
                <main class="d-flex flex-column">
                    <div class="card rounded shadow p-5">
                        <h4>Add a new book</h4>
                        <form action="{{ route('admin.books.store') }}" method="POST" class="mt-5"
                            enctype="multipart/form-data">
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
                                <label for="author">Authors</label>
                                <select multiple name="authors[]" id="author"
                                    class="form-control {{ $errors->has('authors') ? 'is-invalid' : '' }}">
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}"
                                            {{ in_array($author->id, old('authors') ?: []) ? 'selected' : '' }}>
                                            {{ $author->f_name }} {{ $author->l_name }}
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
@endsection
