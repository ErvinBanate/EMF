@extends('layouts.app')

@section('content')
    <div class="container my-4 ">
        <div class="row justify-content-center">
            <table class="table table-bordered table-hover w-75">
                <thead class="thead-dark">
                    <th>Product</th>
                    <th>Stock</th>
                    <th>Product Type</th>
                    <th>Requested By</th>
                    <th>Approve</th>
                    <th>Reject</th>
                </thead>
                <tbody>
                    @foreach ($requestProducts as $requestProduct)
                        @if ($requestProduct->is_approved == 0 && $requestProduct->is_rejected == 0)
                            <tr>
                                <td>{{ $requestProduct->product_name }}</td>
                                <td>{{ number_format($requestProduct->stock) }}</td>
                                <td>{{ $requestProduct->product_type }}</td>
                                <td>{{ $requestProduct->requested_by }}</td>
                                <td class="text-center" style="width: 5%"><a
                                        href="{{ route('approveRequest', $requestProduct->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue"
                                            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg></a></td>
                                <td class="text-center" style="width: 5%"><a
                                        href="{{ route('rejectRequest', $requestProduct->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                                            class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                        </svg>
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
