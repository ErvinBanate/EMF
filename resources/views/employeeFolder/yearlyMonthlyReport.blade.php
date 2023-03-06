@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Yearly and Monthly Report Generator</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Yearly and Monthly Report Generator</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class='text-center'>Monthly Fire Incident Reports</h2>
                        <form action="{{ route('downloadMonthly') }}" class="row mb-2" method="POST">
                            @csrf
                            <div class="col-md-3">
                                <label class="form-label" for="input-month">Month<span style="color:red">*</span></label>
                                <select name="input-month-monthly" class="form-control">
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" for="input-year">Year<span style="color:red">*</span></label>
                                <select name="input-year-monthly" class="form-control">
                                    @for ($year = 1950; $year <= 2050; $year++)
                                        @if ($year === now()->year)
                                            <option value="{{ $year }}" selected>{{ $year }}
                                            </option>
                                        @else
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4" style="display: flex;">
                                <button class="btn btn-primary" type="submit" style="align-self: end;">Export
                                    Monthly Data</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h2 class='text-center'>Yearly Fire Incident Reports</h2>
                        <form action="{{ route('downloadYearly') }}" class="row mb-2" method="POST">
                            @csrf
                            <div class="col-md-2">
                                <label class="form-label" for="input-year">Year<span style="color:red">*</span></label>
                                <select name="input-year-yearly" class="form-control">
                                    @for ($year = 1950; $year <= 2050; $year++)
                                        @if ($year === now()->year)
                                            <option value="{{ $year }}" selected>{{ $year }}
                                            </option>
                                        @else
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4" style="display: flex;">
                                <button class="btn btn-primary" type="submit" style="align-self: end;">Export
                                    Yearly Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
