@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Item List ({{ $product->product_name }})</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('/adminInventory') }}">Inventory Management</a></li>
                <li class="breadcrumb-item active">Item List </li>
            </ol>
        </nav>
    </div>

    <div class="bg-light px-5 mb-2">
        <div style="display: flex; justify-content: right; padding-right: 2vh">
            <form action="{{ route('downloadItems', $itemList[0]->acronym) }}" class="row mb-2" method="POST"
                style="width: 25%">
                @csrf
                <div class="col-md-7">
                    <label class="form-label" for="input-status">Status<span style="color:red">*</span></label>
                    <select name="input-status" class="form-control">
                        <option value="working">Working</option>
                        <option value="under maintenance">Under Maintenace</option>
                        <option value="condemn">Condemn</option>
                    </select>
                </div>
                <div class="col-md-5" style="display: flex;">
                    <button class="btn btn-primary" type="submit" style="align-self: end;">Export PDF</button>
                </div>
            </form>
        </div>
        <div class="row justify-content-center">
            <table class="table table-bordered table-hover table-fixed mt-2">
                <thead class="thead-dark">
                    <th>Item</th>
                    <th>Status</th>
                    <th>Item Type</th>
                    <th>Person Accounted</th>
                    <th>Acquired Date</th>
                    <th>Expiration Date</th>
                    <th colspan="2">Actions</th>
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
                                @if ($product->status == 'working')
                                    <td colspan="2"><a href="{{ route('underMaintenance', $product->id) }}"
                                            class="btn btn-primary">Under Maintenance</a></td>
                                @endif
                                @if ($product->status == 'under maintenance')
                                    <td><a href="{{ route('condemn', $product->id) }}" class="btn btn-primary">Condemn</a>
                                    </td>
                                    <td><a href="{{ route('repaired', $product->id) }}"
                                            class="btn btn-primary">Repaired</a>
                                    </td>
                                @endif
                                @if ($product->status == 'condemn')
                                    <td colspan="2"><a href="{{ route('underMaintenance', $product->id) }}"
                                            class="btn btn-primary">Back to Maintenance</a>
                                    </td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
@endsection
