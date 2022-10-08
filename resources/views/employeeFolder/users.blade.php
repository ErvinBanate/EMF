@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class='text-center'>Registered Users</h1>
                <br>
                <table class="table table-bordered table-hover">
                    <thead>
                        <th class='text-center'>Name</th>
                        <th class='text-center'>Email</th>
                        <th class='text-center'>Role Name</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class='text-center'>{{ $user->name }}</td>
                                <td class='text-center'>{{ $user->email }}</td>
                                <td class='text-center'>{{ $user->role->role_name }}</td>
                                <td class='text-center'><a href="#"><button class="btn btn-primary">Edit</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
