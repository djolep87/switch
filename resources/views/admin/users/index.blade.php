@extends('admin.layouts.app')
@section('title', 'List Users')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users</span></h4>
            {{-- <h6 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Number of users {{ $usersCount }}</span></h6> --}}
            <div class="card">
                {{-- <h5 class="card-header">Users </h5> --}}
                <h5 class="card-header">Users </h5>
                <h6 class="card-header fw-bold py-3 mb-4"><span class="text-muted fw-light">Number of users {{$userCount}}</span></h6>
                <div class="table-responsive text-nowrap">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>Ime</th>
                                <th>Prezime</th>
                                <th>Email</th>
                                <th>Grad</th>
                                <th>Br.tel</th>
                                <th>Adresa</th>
                                <th>Is Admin</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $user->firstName }}</td>
                                    <td>{{ $user->lastName }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->city }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->is_admin }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <!-- PAGINACIJA -->
                        <div class="mt-3">
                            {{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </table>
                </div>
             </div>
        </div>
    </div>
@endsection