@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="newProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form class="g-3" action="{{ route('createProduct') }}" method="POST">
                            @csrf
                            <div class="row modal-body">
                                <div class="col-md-6">
                                    <label class="form-label" for="input-new-product">Item Name</label>
                                    <input class="form-control" type="text" name="input-new-product" autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="input-new-accounted">Accounted Person</label>
                                    <input class="form-control" type="text" name="input-new-accounted"
                                        autocomplete="off">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-quantity">Quantity</label>
                                    <input class="form-control" type="number" name="input-new-quantity" min="1">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" for="input-new-product-type">Item Type</label>
                                    <select class="form-control" name="input-new-product-type">
                                        <option value="Fire Service Vehicles">Fire Service Vehicles</option>
                                        <option value="Firefigther Tools">Firefighter Tools</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label" for="input-new-acquired">Acquired Date</label>
                                    <input class="form-control" type="date" name="input-new-acquired">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label" for="input-new-expiration">Expiration Date</label>
                                    <input class="form-control" type="date" name="input-new-expiration">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Create Item</button>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Item Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form class="g-3" action="{{ route('addStock') }}" method="POST">
                            @csrf
                            <div class="row modal-body">
                                <div class="col-md-6">
                                    <label class="form-label" for="input-add-product">Item Name</label>
                                    <select class="form-control" type="text" name="input-add-product">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->product_name }}">{{ $product->product_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="input-add-accounted">Accounted Person</label>
                                    <input class="form-control" type="text" name="input-add-accounted"
                                        autocomplete="off">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-add-quantity">Quantity</label>
                                    <input class="form-control" type="number" name="input-add-quantity" min="1">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-add-acquired">Acquired Date</label>
                                    <input class="form-control" type="date" name="input-add-acquired">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-add-expiration">Expiration Date</label>
                                    <input class="form-control" type="date" name="input-add-expiration">
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
    {{-- <div class="modal fade" id="removeStockModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Remove Item Stock</h5>
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
                                    <label class="form-label" for="input-remove-product">Item Name</label>
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
    </div> --}}

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
                        New Item
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStockModal">
                        Add Stock
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light px-5">
        <div class="row justify-content-center">
            <table class="table table-bordered table-hover table-fixed">
                <thead class="thead-dark">
                    <th>Item</th>
                    <th>Total Stock</th>
                    <th>Working Stock</th>
                    <th>Not Working Stock</th>
                    <th>Item Type</th>
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
                            <td class="text-center"><a href="{{ route('viewItemList', $product->id) }}">
                                    <button class="btn btn-primary">View</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
