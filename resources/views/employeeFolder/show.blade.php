@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        @if ($action === 'show')
            <h3>View Incident Report</h3>
        @endif
        @if ($action === 'ApproveOrReject')
            <h3>Confirm Incident Report</h3>
        @endif
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('/incidentReport') }}">Fire Incident Reports</a></li>
                @if ($action === 'show')
                    <li class="breadcrumb-item active">View Incident Reports</li>
                @endif
                @if ($action === 'ApproveOrReject')
                    <li class="breadcrumb-item active">Confirm Incident Reports</li>
                @endif
            </ol>
        </nav>
    </div>
    {{-- <div class="container"> --}}
    {{-- <div class="row justify-content-center">
        <div class="col-md-12">
            <form class="row g-3">
                <div class="col-md-2">
                    <label class="form-label" for="input-baranggay">Baranggay</label>
                    <p class="form-control">{{ $report->baranggay }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="input-location">Location</label>
                    <p class="form-control">{{ $report->location }}</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-date">Date</label>
                    <p class="form-control">{{ $report->month }} {{ $report->day }}, {{ $report->year }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="input-fire-alarm-level">Fire Alarm Level</label>
                    <p class="form-control">{{ $report->fire_alarm_level }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="input-cause-of-incident">Cause of Incident</label>
                    <p class="form-control">{{ $report->cause_of_incident }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="input-estimated-damage">Estimated Damage</label>
                    <p class="form-control">&#8369;{{ number_format($report['estimated_damage']) }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="input-reported-by">Reported By</label>
                    <p class="form-control">{{ $report->reportedBy->name }}</p>
                </div>
                <div class="col-md-12" style="height: 350px">
                    <label class="form-label" for="input-description">Description</label>
                    <textarea class="form-control" style="height: 90%; background-color: white" disabled>{{ strip_tags($report->description) }}</textarea>
                </div>
                <div class="col-md-12 ">
                    @if ($action === 'edit')
                        <button class="btn btn-primary" type="submit">Update</button>
                    @endif
                    @if ($action === 'ApproveOrReject')
                        <a href="{{ route('approve', $report->id) }}" class="btn btn-primary">Approve</a>
                        <a href="{{ route('reject', $report->id) }}" class="btn btn-primary">Reject</a>
                    @endif
                </div>
                @if ($action === 'report')
                    <div class="col-12">
                        <a type="button" class="btn btn-info" href="{{ route('downloadReportPdf', $report->id) }}">Export
                            as PDF</a>
                    </div>
                @endif
            </form>
        </div>
    </div> --}}
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form class="row g-3" method="POST" action="{{ route('update', $report->id) }}">
                @csrf
                <div class="col-md-2">
                    <label class="form-label" for="input-baranggay">Baranggay</label>
                    <p class="form-control">{{ $report->baranggay }}</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-location">Exact Location</label>
                    <p class="form-control">{{ $report->location }}</p>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-start-month">(Incident Started) Month</label>
                    <p class="form-control">{{ $report->start_month }}</p>
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="input-start-day">Day</label>
                    <p class="form-control">{{ $report->start_day }}</p>
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="input-start-year">Year</label>
                    <p class="form-control">{{ $report->start_year }}</p>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-start-time">Time</label>
                    <p class="form-control">{{ $report->time_started }}</p>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-fire-alarm-level">Highest Fire Alarm Level</label>
                    <p class="form-control">{{ $report->fire_alarm_level }}</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-cause-of-incident">Cause of Incident</label>
                    <p class="form-control">{{ $report->cause_of_incident }}</p>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-end-month">(Incident Ended) Month</label>
                    <p class="form-control">{{ $report->end_month }}</p>
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="input-end-day">Day</label>
                    <p class="form-control">{{ $report->end_day }}</p>
                </div>
                <div class="col-md-1">
                    <label class="form-label" for="input-end-year">Year</label>
                    <p class="form-control">{{ $report->end_year }}</p>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-end-time">Time</label>
                    <p class="form-control">{{ $report->time_ended }}</p>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="input-estimated-damage">Estimated Damage</label>
                    <p class="form-control">{{ $report->estimated_damage }}</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-reported-by">Reported By</label>
                    <p class="form-control">{{ $report->reportedBy->name }}</p>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-families-affected">Number of Families Affected</label>
                    <p class="form-control">{{ $report->reportedBy->name }}</p>
                </div>
                <div class="col-md-12" style="height: 200px">
                    <label class="form-label" for="input-description">Description</label>
                    <textarea class="form-control" style="height: 90%; background-color: white" disabled>{{ strip_tags($report->description) }}</textarea>
                </div>
                <div class="col-12 mt-3">
                    @if ($action === 'edit')
                        <button class="btn btn-primary" type="submit">Update</button>
                    @endif
                    @if ($action === 'ApproveOrReject')
                        <a href="{{ route('approve', $report->id) }}" class="btn btn-primary">Approve</a>
                        <a href="{{ route('reject', $report->id) }}" class="btn btn-primary">Reject</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    {{-- </div> --}}
@endsection
