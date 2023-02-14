@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Inventory Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form class="g-3" action="{{ route('createNewProductRequest') }}" method="POST">
                            @csrf
                            <div class="row modal-body">
                                <div class="col-md-6">
                                    <label class="form-label" for="input-new-product">Product</label>
                                    <input class="form-control" type="text" name="input-product">
                                    <input class="form-control" type="hidden" name="input-requested-by"
                                        value="{{ Auth::user()->name }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="input-new-product-type">Product Type</label>
                                    <select class="form-control" name="input-product-type">
                                        <option value="Fire Service Vehicles">Fire Service Vehicles</option>
                                        <option value="Firefigther Tools">Firefigther Tools</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-quantity">Quantity</label>
                                    <input class="form-control" type="number" name="input-quantity" min="1">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-acquired">Acquired Date</label>
                                    <input class="form-control" type="date" name="input-aquired">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-expiration">Expiration Date</label>
                                    <input class="form-control" type="date" name="input-expiration">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Create Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pagetitle">
        <h3>Inventory Request</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Inventory Request</li>
            </ol>
        </nav>
    </div>

    <div class="my-4 px-4 py-3 bg-light shadow">
        <div class="mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Create Request
            </button>
        </div>
        <div class="row justify-content-center">
            <table class="table table-bordered table-hover table-fixed">
                <thead class="thead-dark">
                    <th>Product</th>
                    <th>Stock</th>
                    <th>Product Type</th>
                    <th>Requested By</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($requestProducts as $requestProduct)
                        @if ($requestProduct->is_approved == 0 && $requestProduct->is_rejected == 0)
                            <tr>
                                <td>{{ $requestProduct->product_name }}</td>
                                <td>{{ number_format($requestProduct->stock) }}</td>
                                <td>{{ $requestProduct->product_type }}</td>
                                <td>{{ $requestProduct->requested_by }}</td>
                                <td class="text-center"><a href="{{ route('removeRequest', $requestProduct->id) }}">
                                        <button class="btn btn-primary">Remove</button></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
