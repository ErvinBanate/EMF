@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="rejectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Rejection Notes<span style="color: red">*</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form class="g-3" method="POST" action="{{ route('reject', $report->id) }}">
                            @csrf
                            <div class="row modal-body">
                                <div class="col-md-12">
                                    <textarea class="form-control" type="date" name="input-rejection-notes" rows="5" style="resize: none"></textarea>
                                    @error('input-rejection-notes')
                                        <span class="invalidFeedback" role="alert" style="color: red">
                                            {{ str_replace('input-rejection-notes', 'Rejection Notes', $message) }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">Reject</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form class="row g-3" method="POST" action="{{ route('update', $report->id) }}">
                @csrf
                <div class="col-md-2">
                    <label class="form-label" for="input-baranggay">Baranggay</label>
                    <p class="form-control">{{ $report->baranggay }}</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-location">Exact Location of Fire Incident</label>
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
                    <p class="form-control">&#8369;{{ number_format($report->estimated_damage) }}</p>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="input-reported-by">Reported By</label>
                    <p class="form-control">{{ $report->reportedBy->name }}</p>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="input-families-affected">Number of Families Affected</label>
                    <p class="form-control">{{ $report->families_affected }}</p>
                </div>
                <div class="col-md-12" style="height: 150px">
                    <label class="form-label" for="input-description">Description</label>
                    <textarea class="form-control" style="height: 75%; background-color: white" disabled>{{ strip_tags($report->description) }}</textarea>
                </div>
                <div class="col-md-12 mt-3">
                    <div style="container">
                        <img src="{{ asset('Image/' . $report->image) }}" alt="Evidence Image"
                            style="width: 350px; display: block; margin-left: auto; margin-right: auto;">
                    </div>
                </div>
                <div class="col-12 mt-3">
                    @if ($action === 'show')
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                        <a href="{{ route('downloadReportPdf', $report['id']) }}" class="btn btn-primary">Export PDF</a>
                    @endif
                    @if ($action === 'edit')
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                        <button class="btn btn-primary" type="submit">Update</button>
                    @endif
                    @if ($action === 'ApproveOrReject')
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                        <a href="{{ route('approve', $report->id) }}" class="btn btn-primary">Approve</a>
                        <button class="btn btn-primary" type="button" data-toggle="modal"
                            data-target="#rejectionModal">Return</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
