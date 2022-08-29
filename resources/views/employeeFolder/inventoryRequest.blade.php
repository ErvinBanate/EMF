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
                                <div class="col-md-5">
                                    <label class="form-label" for="input-new-product">Product</label>
                                    <input class="form-control" type="text" name="input-product">
                                    <input class="form-control" type="hidden" name="input-requested-by"
                                        value="{{ Auth::user()->name }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="input-new-quantity">Quantity</label>
                                    <input class="form-control" type="text" name="input-quantity">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-product-type">Product Type</label>
                                    <select class="form-control" name="input-product-type">
                                        <option value="Equipment">Equipment</option>
                                        <option value="Consumables">Consumables</option>
                                    </select>
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

    <div class="container my-4 ">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Create Request
        </button>
        <div class="row justify-content-center">
            <table class="table table-bordered table-hover w-75">
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
                                <td class="text-center" style="width: 5%"><a
                                        href="{{ route('removeRequest', $requestProduct->id) }}">
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
