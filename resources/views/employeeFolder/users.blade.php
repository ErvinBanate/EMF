@extends('layouts.admin')

@section('content')
    <div class="pagetitle">
        <h3>List of Users</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">List of Users</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 bg-light pt-3">
                <table class="table table-bordered table-hover table-fixed">
                    <thead class="thead-dark">
                        <th class='text-center'>Name</th>
                        <th class='text-center'>Email</th>
                        <th class='text-center'>Role Name</th>
                        {{-- <th class="text-center" colspan="2">Actions</th> --}}
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class='text-center'>{{ $user->name }}</td>
                                <td class='text-center'>{{ $user->email }}</td>
                                <td class='text-center'>{{ $user->role->role_name }}</td>
                                {{-- <td class='text-center'><a href="{{ route('editUser', $user->id) }}"><button
                                            class="btn btn-primary">Edit User Details</button></a>
                                </td>
                                <td class='text-center'><a href="{{ route('changePassword', $user->id) }}"><button
                                            class="btn btn-primary">Change Password</button></a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
