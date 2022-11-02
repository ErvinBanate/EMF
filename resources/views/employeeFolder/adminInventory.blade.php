@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="newProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form class="g-3" action="{{ route('createProduct') }}" method="POST">
                            @csrf
                            <div class="row modal-body">
                                <div class="col-md-5">
                                    <label class="form-label" for="input-new-product">Product</label>
                                    <input class="form-control" type="text" name="input-new-product">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="input-new-quantity">Quantity</label>
                                    <input class="form-control" type="text" name="input-new-quantity">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-product-type">Product Type</label>
                                    <select class="form-control" name="input-new-product-type">
                                        <option value="Fire Service Vehicles">Fire Service Vehicles</option>
                                        <option value="Firefigther Tools">Firefigther Tools</option>
                                        <option value="Wildfire Suppression Equipment">Wildfire Suppression Equipment
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Create Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addStockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Product Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form class="g-3" action="{{ route('addStock') }}" method="POST">
                            @csrf
                            <div class="row modal-body">
                                <div class="col-md-8">
                                    <label class="form-label" for="input-add-product">Product Name</label>
                                    <select class="form-control" type="text" name="input-add-product">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->product_name }}">{{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="input-add-quantity">Quantity</label>
                                    <input class="form-control" type="text" name="input-add-quantity">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Add Stock</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="removeStockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Remove Product Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form class="g-3" action="{{ route('removeStock') }}" method="POST">
                            @csrf
                            <div class="row modal-body">
                                <div class="col-md-8">
                                    <label class="form-label" for="input-remove-product">Product Name</label>
                                    <select class="form-control" type="text" name="input-remove-product">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->product_name }}">{{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="input-remove-quantity">Quantity</label>
                                    <input class="form-control" type="text" name="input-remove-quantity">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Remove Stock</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pagetitle">
        <h3>Inventory Management</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Inventory Management</li>
            </ol>
        </nav>
    </div>

    <div class=" bg-light">
        <div class="p-4">
            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newProductModal">
                        New Product
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStockModal">
                        Add Stock
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#removeStockModal">
                        Remove Stock
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light px-5">
        <div class="row justify-content-center">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <th>Product</th>
                    <th>Total Stock</th>
                    <th>Working Stock</th>
                    <th>Not Working Stock</th>
                    <th>Product Type</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ number_format($product->total_stock) }}</td>
                            <td>{{ number_format($product->working_stock) }}</td>
                            <td>{{ number_format($product->not_working_stock) }}</td>
                            <td>{{ $product->product_type }}</td>
                            <td class="text-center" style="width: 5%"><a
                                    href="{{ route('removeProduct', $product->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                                        class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
