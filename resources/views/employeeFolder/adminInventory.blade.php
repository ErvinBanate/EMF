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
                                    @error('input-new-product')
                                        <span class="invalidFeedback" role="alert" style="color:red">
                                            {{ str_replace('input-new-product', 'Item Name', $message) }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="input-new-accounted">Accounted Person</label>
                                    <input class="form-control" type="text" name="input-new-accounted"
                                        autocomplete="off">
                                    @error('input-new-accounted')
                                        <span class="invalidFeedback" role="alert" style="color:red">
                                            {{ str_replace('input-new-accounted', 'Accounted Person', $message) }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-quantity">Quantity</label>
                                    <input class="form-control" type="number" name="input-new-quantity" min="1">
                                    @error('input-new-quantity')
                                        <span class="invalidFeedback" role="alert" style="color:red">
                                            {{ str_replace('input-new-quantity', 'Quantity', $message) }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" for="input-new-product-type">Item Type</label>
                                    <select class="form-control" name="input-new-product-type">
                                        <option value="Fire Service Vehicles">Fire Service Vehicles</option>
                                        <option value="Firefigther Tools">Firefighter Tools</option>
                                    </select>
                                    @error('input-new-product-type')
                                        <span class="invalidFeedback" role="alert" style="color:red">
                                            {{ str_replace('input-new-product-type', 'Item Type', $message) }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label" for="input-new-acquired">Acquired Date</label>
                                    <input class="form-control" type="date" name="input-new-acquired">
                                    @error('input-new-acquired')
                                        <span class="invalidFeedback" role="alert" style="color:red">
                                            {{ str_replace(['input-new-acquired', 'input-new-expiration'], ['Acquired Date', 'Expiration Date'], $message) }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label" for="input-new-expiration">Expiration Date</label>
                                    <input class="form-control" type="date" name="input-new-expiration">
                                    @error('input-new-expiration')
                                        <span class="invalidFeedback" role="alert" style="color:red">
                                            {{ str_replace('input-new-expiration', 'Expiration Date', $message) }}
                                        </span>
                                    @enderror
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
                                    @error('input-add-accounted')
                                        <span class="invalidFeedback" role="alert" style="color:red">
                                            {{ str_replace('input-add-accounted', 'Accounted Person', $message) }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-add-quantity">Quantity</label>
                                    <input class="form-control" type="number" name="input-add-quantity" min="1">
                                    @error('input-add-quantity')
                                        <span class="invalidFeedback" role="alert" style="color:red">
                                            {{ str_replace('input-add-quantity', 'Quantity', $message) }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-add-acquired">Acquired Date</label>
                                    <input class="form-control" type="date" name="input-add-acquired">
                                    @error('input-add-acquired')
                                        <span class="invalidFeedback" role="alert" style="color:red">
                                            {{ str_replace(['input-add-acquired', 'input-add-expiration'], ['Acquired Date', 'Expiration Date'], $message) }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-add-expiration">Expiration Date</label>
                                    <input class="form-control" type="date" name="input-add-expiration">
                                    @error('input-add-expiration')
                                        <span class="invalidFeedback" role="alert" style="color:red">
                                            {{ str_replace('input-add-expiration', 'Expiration Date', $message) }}
                                        </span>
                                    @enderror
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

    <div class="pagetitle">
        <h3>Item Management</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Item Management</li>
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
        <div class="mb-2" style="display: flex; justify-content: right; padding-right: 2vh">
            <select id="search-category" class="form-control mr-1" style="width: 9%">
                <option value="product_name">Item Name</option>
                <option value="product_type">Item Type</option>
            </select>
            <label for="search" class="form-label mr-2 pt-1" style="font-size: 15px">Search:</label>
            <input type="text" class="form-controller" id="search" name="search">
        </div>
        <div class="row justify-content-center">
            <table class="table table-bordered table-hover table-fixed">
                <thead class="thead-dark">
                    <th>Item Name</th>
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
                                    <button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-eye"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg></button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript">
            $('#search').on('keyup', function() {
                $value = $(this).val();
                $category = $('#search-category').val();
                // console.log($value);
                $.ajax({
                    type: 'post',
                    url: 'http://localhost:8000/searchInventory',
                    data: {
                        'search': $value,
                        'category': $category,
                    },
                    success: function(data) {
                        console.log(data);
                        $('tbody').html(data);
                    }
                });
            })
        </script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </div>
@endsection
