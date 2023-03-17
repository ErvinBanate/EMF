@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Item Requests</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Item Requests</li>
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
        <div class="row justify-content-center p-4 bg-light">
            <table class="table table-bordered table-hover table-fixed">
                <thead class="thead-dark">
                    <th>Item</th>
                    <th>Stock</th>
                    <th>Item Type</th>
                    <th>Requested By</th>
                    <th colspan="2"></th>
                </thead>
                <tbody>
                    @foreach ($requestProducts as $requestProduct)
                        @if ($requestProduct->is_approved == 0 && $requestProduct->is_rejected == 0)
                            <tr>
                                <td>{{ $requestProduct->product_name }}</td>
                                <td>{{ number_format($requestProduct->stock) }}</td>
                                <td>{{ $requestProduct->product_type }}</td>
                                <td>{{ $requestProduct->requested_by }}</td>
                                <td class="text-center"><a href="{{ route('approveRequest', $requestProduct->id) }}">
                                        <button class="btn btn-primary">Approve</button></a>
                                </td>
                                <td class="text-center"><a href="{{ route('rejectRequest', $requestProduct->id) }}">
                                        <button class="btn btn-primary">Reject</button></a>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
