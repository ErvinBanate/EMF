@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Inventory</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Inventory</li>
            </ol>
        </nav>
    </div>
    <div class="my-4">
        <div class="row justify-content-center p-4 bg-light shadow">
            <table class="table table-bordered table-hover overflowTable">
                <thead class="thead-dark">
                    <th>Product</th>
                    <th>Total Stock</th>
                    <th>Working Stock</th>
                    <th>Not Working Stock</th>
                    <th>Product Type</th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ number_format($product->total_stock) }}</td>
                            <td>{{ number_format($product->working_stock) }}</td>
                            <td>{{ number_format($product->not_working_stock) }}</td>
                            <td>{{ $product->product_type }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
