@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container-fluid">
        <div class="row mt-5 ">
            @include('inc.admin.sidebar')
            <div class="col-sm col-md-8 col-lg-9 col-xl-8">
                <main>
                    <div class="d-flex align-items-center">
                        <h4 class="mr-3">Users</h4>
                    </div>

                    @if (count($users) === 0)
                        <h4>No Users found!</h4>
                    @else
                        <div class="table-responsive mt-5">
                            <table class="table table-hover">
                                <thead class="purple-bg text-white">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">First name</th>
                                        <th scope="col">Last name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->f_name }}</td>
                                            <td>{{ $user->l_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->roles[0]->name }}</td>
                                            {{-- <td
                                                class="d-flex justify-content-lg-between">
                                                <a href="{{ route('admin.books.show', $book->id) }}">View</a>
                                                <a href="{{ route('admin.books.edit', $book->id) }}">Edit</a>
                                                <form method="POST" action="{{ route('admin.books.destroy', $book->id) }}">
                                                    <input type="hidden" value="DELETE" name="_method">
                                                    @csrf
                                                    <input class="input-delete" type="submit" value="Delete">
                                                </form>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $users->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </div>
@endsection
