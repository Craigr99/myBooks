@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7 reviewBackground">
        <div class="row">
            <div class="col col-xl-8 offset-xl-2 mt-5">
                <div class="card ">
                    <div class="card-header">
                        <h4 class="reviewTitle">{{ $book->title }}</h4>
                        <img class="rounded" src="{{ $book->image }}" width="160px" alt="Book cover image">
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
                        <form method="POST" action="{{ route('user.reviews.store', $book->id) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="title" class="reviewTitle reviewTitlePush">Title of Review</label>
                                <input type="text" class="form-control reviewHead" id="title" name="title"
                                    value="{{ old('title') }}" />
                            </div>
                            <div class="form-group">
                                  <label for="body" class="reviewTitlePush1">What was your overall experience reading this book?</label>
                                <input type="text" class="form-control reviewBody" id="body" name="body" value="{{ old('body') }}" />
                            </div>
                            <a href="{{ route('user.home') }}" class="btn btn-warning">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
