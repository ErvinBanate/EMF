@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Item List</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('/adminInventory') }}">Inventory Management</a></li>
                <li class="breadcrumb-item active">Item List</li>
            </ol>
        </nav>
    </div>

    <div class="bg-light px-5">
        <div class="row justify-content-center">
            <table class="table table-bordered table-hover table-fixed mt-3">
                <thead class="thead-dark">
                    <th>Item</th>
                    <th>Status</th>
                    <th>Item Type</th>
                    <th>Person Accounted</th>
                    <th>Acquired Date</th>
                    <th>Expiration Date</th>
                </thead>
                <tbody>
                    @foreach ($itemList as $product)
                        @php
                            $acronym = explode('-', $product->item_number);
                        @endphp
                        @if ($productAcronym == $acronym[0])
                            <tr>
                                <td>{{ $product->item_number }}</td>
                                <td>{{ $product->status }}</td>
                                <td>{{ $product->item_type }}</td>
                                <td>{{ $product->person_accounted }}</td>
                                <td>{{ $product->aquired_date }}</td>
                                <td>{{ $product->expiration_date }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
