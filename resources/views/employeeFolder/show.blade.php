@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($action === 'ApproveOrReject')
                    <h1 class='text-center'>Confirm Fire Incident Report</h1>
                @endif
                @if ($action === 'show')
                    <h1 class='text-center'>Incident Report</h1>
                    <div class="row g-3">
                @endif
                <br>
                @if ($action === 'ApproveOrReject')
                    <div class="row g-3">
                @endif
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
                <div class="col-md-12" style="height: 200px">
                    <label class="form-label" for="input-description">Description</label>
                    <textarea class="form-control" style="height: 90%; background-color: white" disabled>{!! nl2br(e($report->description)) !!}</textarea>
                </div>
                <div class="col-12">
                    @if ($action === 'edit')
                        <button class="btn btn-primary" type="submit">Update</button>
                    @endif
                    @if ($action === 'ApproveOrReject')
                        <a href="{{ route('approve', $report->id) }}"><button class="btn btn-primary">Approve</button></a>
                        <a href="{{ route('reject', $report->id) }}"><button class="btn btn-primary">Reject</button></a>
                    @endif
                </div>
                @if ($action === 'show')
                    <div class="col-12">
                        <a type="button" class="btn btn-info" href="{{ route('downloadReportPdf', $report->id) }}">Export
                            as PDF</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
