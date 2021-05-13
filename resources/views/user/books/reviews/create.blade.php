@extends('layouts.app')

@section('content')
    <div class="h-100 d-flex flex-row align-items-center justify-content-center">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="card-header h-100">
                                <span class="subtitle-2 text-primary-500">Write a review on</span>
                                <h4 class="reviewTitle">{{ $book->title }}</h4>
                                <img class="rounded" src="{{ $book->image }}" width="160px" alt="Book cover image">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible" role="alert">
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
                                        <label for="body" class="reviewTitlePush1">What was your overall experience reading
                                            this
                                            book?</label>
                                        <input type="text" class="form-control reviewBody" id="body" name="body"
                                            value="{{ old('body') }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="rating">Rating</label>
                                        <select class="form-control" name="rating" id="rating">
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <a href="{{ route('user.home') }}" class="btn my-btn my-btn-outline mt-3">Cancel</a>
                                    <button type="submit" class="btn my-btn my-btn-primary mt-3">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
