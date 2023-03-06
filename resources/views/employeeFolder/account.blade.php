@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Account Details</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Account Details</li>
            </ol>
        </nav>
    </div>
    @if (Session::has('success'))
        <div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert'>
                <i class='fa fa-times'></i>
            </button>
            <strong>Success ! {{ Session::get('success') }}</strong>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <p class="form-control">{{ Auth::user()->name }}</p>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <p class="form-control">{{ Auth::user()->email }}</p>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                @foreach ($users as $user)
                                    @if ($user->id == Auth::user()->id)
                                        <div class="col-3">
                                            <a href="{{ route('editUser', $user->id) }}" class="btn btn-primary">Edit User
                                                Details</a>
                                        </div>
                                        <div class="col-4">
                                            <a href="{{ route('changePassword', $user->id) }}"
                                                class="btn btn-primary">Change Password</a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

                                <div class="col-md-6">
                                    <p class="form-control">{{ $role }}</p>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
