@extends('layouts.app')

@section('content')
  <div class="container-fluid bg-gray-7">
    <div class="row">
      @include('inc.admin.sidebar')
      <div class="col col-xl-8 offset-xl-2 mt-5">
        <div class="card">
          <div class="card-header">
            {{ $book->title}}: Add a Review
          </div>

          <div class="panel-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="POST" action="{{ route('admin.reviews.store', $book->id) }}">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" />
                          </div>
                          <div class="form-group">
                              <label for="body">Body</label>
                              <input type="text" class="form-control" id="body" name="body" value="{{ old('body') }}" />
                          </div>
                          <a href="{{ route('admin.books.show', $book->id) }}" class="btn btn-default">Cancel</a>
                          <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
