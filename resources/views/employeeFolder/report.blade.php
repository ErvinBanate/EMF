@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Summary Report</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item">Generate Reports</li>
                <li class="breadcrumb-item active">Summary Report</li>
            </ol>
        </nav>
    </div>
    <div class="container bg-light shadow py-4">
        <div class="row justify-content-center pb-3 my-3">
            <div class="col-md-3">
                <h5>Approved Reports: {{ $approved }}</h5>
            </div>
            <div class="col-md-3">
                <h5>Pending Reports: {{ $pending }}</h5>
            </div>
            <div class="col-md-3">
                <h5>Rejected Reports: {{ $rejected }}</h5>
            </div>
            <div class="col-md-3">
                <h5>Total Annual Reports: {{ $all }}</h5>
            </div>
        </div>
        <div class="row justify-content-around my-3">
            <div class="row border col-md-5 py-4">
                <div class="col-md-12">
                    <h4 class="text-center"><strong>Top 3 Highest Rate of Cause of Incident</strong></h5>
                </div>
                <div class="d-flex justify-content-center">
                    <ul>
                        @foreach ($topCOI as $topCause)
                            <li>
                                <h5>{{ $topCause->cause_of_incident }}: {{ $topCause->total }}</h5>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row border col-md-5 py-4">
                <div class="col-md-12">
                    <h4 class="text-center"><strong>Top 3 Highest Estimated Damage</strong></h5>
                </div>
                <div class="d-flex justify-content-center">
                    <ul>
                        @foreach ($lowStreets as $lowStreet)
                            <li>
                                <h5 class="text-center">&#8369;{{ number_format($lowStreet->estimated_damage) }}</h5>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
