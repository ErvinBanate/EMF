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
    
    <div class="container">
        <div class="py-4">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center"><strong>Inventory Management</strong></h1>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        New Product
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Add Stock
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Remove Stock
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4 ">
        <div class="row justify-content-center">
            <table class="table table-bordered table-hover w-75">
                <thead class="thead-dark">
                    <th>Product</th>
                    <th>Stock</th>
                    <th>Product Type</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ number_format($product->stock) }}</td>
                            <td>{{ $product->product_type }}</td>
                            <td class="text-center" style="width: 5%"><a href="{{ route('removeProduct', $product->id) }}">
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

    <script>
        const style = `background-color: lightgreen; color: white;`;

        function newProductForm() {
            const display = `<div class="row justify-content-center">
            <form class="row justify-content-center w-75 g-3 border p-4" action="{{ route('createProduct') }}" method="POST">
                @csrf
                <div class="col-md-4">
                    <label class="form-label" for="input-new-product">Product</label>
                    <input class="form-control" type="text" name="input-new-product">
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-new-quantity">Quantity</label>
                    <input class="form-control" type="text" name="input-new-quantity">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="input-new-product-type">Product Type</label>
                    <select class="form-control" name="input-new-product-type">
                        <option value="Equipment">Equipment</option>
                        <option value="Consumables">Consumables</option>
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
            </div>`;

            document.getElementById('inventoryForm').innerHTML = display;
            document.getElementById('newProduct').style = style;
            document.getElementById('addRemoveStock').style = '';
        }

        function addRemoveStockForm() {
            const display = `<div class="row justify-content-around">
                <div class="col-5 border p-4">
                    <h3 class="text-center">Add Product Stock</h3>
                    <form class="row g-3 justify-content-center" action="{{ route('addStock') }}" method="POST">
                        @csrf
                        <div class="col-md-4">
                            <label class="form-label" for="input-add-product">Product Name</label>
                            <select class="form-control" type="text" name="input-add-product">
                                @foreach ($products as $product)
                                    <option value="{{ $product->product_name }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="input-add-quantity">Quantity</label>
                            <input class="form-control" type="text" name="input-add-quantity">

                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>

                <div class="col-5 border p-4">
                    <h3 class="text-center">Remove Product Stock</h3>
                    <form class="row g-3 justify-content-center" action="{{ route('removeStock') }}" method="POST">
                        @csrf
                        <div class="col-md-4">
                            <label class="form-label" for="input-remove-product">Product Name</label>
                            <select class="form-control" type="text" name="input-remove-product">
                                @foreach ($products as $product)
                                    <option value="{{ $product->product_name }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="input-remove-quantity">Quantity</label>
                            <input class="form-control" type="text" name="input-remove-quantity">

                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>`;

            document.getElementById('inventoryForm').innerHTML = display;
            document.getElementById('newProduct').style = '';
            document.getElementById('addRemoveStock').style = style;
        }
    </script>
@endsection
