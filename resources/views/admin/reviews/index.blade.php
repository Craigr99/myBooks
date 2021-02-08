@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-gray-7">
        <div class="row">
            @include('inc.admin.sidebar')

            <div class="col-sm-8 col-lg-9 col-xl-10">
                <x-flash-message />
                @include('inc.navbar')
                <div class="col mt-5">
                    <main>
                        <div class="d-flex align-items-center">
                            <h4 class="mr-3">Reviews</h4>
                        </div>

                        @if (count($reviews) === 0)
                            <h4>No Reviews found!</h4>
                        @else
                            <div class="table-responsive mt-3">
                                <table class="table table-hover">
                                    <thead class="bg-primary-700 text-white">
                                        <tr>
                                            <th scope="col">Review Title</th>
                                            <th scope="col">Review Text</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $review)
                                            <tr class="table-light">
                                                <td>{{ $review->title }}</td>
                                                <td>{{ $review->body }}</td>

                                                <td class="d-flex justify-content-lg-between btn btn-danger">
                                                    <a href="#" data-toggle="modal" data-target="#delete-modal-review">Delete</a>
                                                </td>
                                            </tr>
                                            <x-flash-modal :id="$review->id" />
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {!! $reviews->links('pagination::bootstrap-4') !!}
                                </div>
                            </div>
                        @endif
                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection
