@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container-fluid">
        <div class="row mt-5 ">
            @include('inc.sidebar')
            <div class="col-sm-8 col-lg-9 col-xl-10">
                <main>
                    <div class="d-flex align-items-center">
                        <h4 class="mr-3"> Books</h4>
                        <a class="btn-link" href="{{ route('admin.books.create') }}">Add</a>
                    </div>

                    <div class="table-responsive mt-5">
                        <table class="table ">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection
