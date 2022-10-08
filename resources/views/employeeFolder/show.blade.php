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
                <li class="breadcrumb-item active"><a href="{{ url('/incidentReport') }}">Incident Reports</a></li>
                @if ($action === 'show')
                    <li class="breadcrumb-item active">View Incident Reports</li>
                @endif
                @if ($action === 'ApproveOrReject')
                    <li class="breadcrumb-item active">Confirm Incident Reports</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label" for="input-baranggay">Baranggay</label>
                        <p class="form-control">{{ $report->baranggay }}</p>
                    </div>
                    <div class="col-md-7">
                        <label class="form-label" for="input-location">Location</label>
                        <p class="form-control">{{ $report->location }}</p>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="input-date">Date</label>
                        <p class="form-control">{{ $report->date }}</p>
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
                        <textarea class="form-control" style="height: 90%; background-color: white" disabled>{!! nl2br(e($report->description)) !!}</textarea>
                    </div>
                    <div class="col-md-12">
                        @if ($action === 'edit')
                            <button class="btn btn-primary" type="submit">Update</button>
                        @endif
                        @if ($action === 'ApproveOrReject')
                            <a href="{{ route('approve', $report->id) }}"><button
                                    class="btn btn-primary">Approve</button></a>
                            <a href="{{ route('reject', $report->id) }}"><button
                                    class="btn btn-primary">Reject</button></a>
                        @endif
                    </div>
                    @if ($action === 'show')
                        <div class="col-12">
                            <a type="button" class="btn btn-info"
                                href="{{ route('downloadReportPdf', $report->id) }}">Export
                                as PDF</a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
