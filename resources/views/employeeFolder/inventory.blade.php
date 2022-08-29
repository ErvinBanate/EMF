@extends('layouts.app')

@section('content')
    <div class="container my-4 ">
        <div class="row justify-content-center">
            <table class="table table-bordered table-hover w-75">
                <thead class="thead-dark">
                    <th>Product</th>
                    <th>Stock</th>
                    <th>Product Type</th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ number_format($product->stock) }}</td>
                            <td>{{ $product->product_type }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
