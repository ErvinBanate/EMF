@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Executives List</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Executives List</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class='text-center'>List of Executives</h2>
                        @foreach ($executives as $executive)
                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-3 col-form-label text-md-end">{{ $executive->position }}</label>

                                <div class="col-md-6">
                                    <p class="form-control">{{ $executive->name }}</p>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-1" style="display: flex;">
                                    <a href="{{ route('editExecutive', $executive->id) }}" class="btn btn-primary"
                                        style="align-self: start">Edit</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
