@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.user.sidebar')
            <div class="col">
                <x-flash-message />
                @include('inc.navbar')
                <div class="col col-xl-8 offset-xl-2 mt-5">
                    <main class="card card-body rounded">
                        <h4 class="my-4">Edit Blog Post</h4>
                        <form action="{{ route('user.blogs.update', $blog->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title"
                                    class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                    value="{{ old('title', $blog->title) }}" placeholder="Blog Title" />
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="subtitle">Sub-title (optional)</label>
                                <input type="text" name="subtitle" id="subtitle"
                                    class="form-control {{ $errors->has('subtitle') ? 'is-invalid' : '' }}"
                                    value="{{ old('title', $blog->subtitle) }}" placeholder="Sub-title (optional)">
                                @if ($errors->has('subtitle'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('subtitle') }}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="image">Blog image (optional)</label>
                                <div class="custom-file">

                                    <input type="file" name="image"
                                        class="custom-file-input {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                        id="image">
                                    <label class="custom-file-label" for="image">Upload image</label>
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback">
                                            {{ $errors->first('image') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" id="body"
                                    class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                                    placeholder="Blog body" rows="20">{{ old('body', $blog->body) }}</textarea>
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                        {{ $errors->first('body') }}
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn my-btn my-btn-primary mt-3">Update blog</button>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>

@endsection
