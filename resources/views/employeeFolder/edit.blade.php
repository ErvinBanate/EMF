@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Edit Incident Reports</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ url('/incidentReport') }}">Incident Reports</a></li>
                <li class="breadcrumb-item active">Edit Incident Reports</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form class="row g-3" method="POST" action="{{ route('update', $report->id) }}">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label" for="input-baranggay">Baranggay</label>
                        <input class="form-control" type="text" name="input-baranggay" value="{{ $report->baranggay }}">
                    </div>
                    <div class="col-md-7">
                        <label class="form-label" for="input-location">Exact Location</label>
                        <input class="form-control" type="text" name="input-location" value="{{ $report->location }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label" for="input-date">Date</label>
                        <input class="form-control" type="date" name="input-date" value="{{ $report->date }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="input-fire-alarm-level">Fire Alarm Level</label>
                        <select class="form-control" name="input-fire-alarm-level" value="{{ $report->fire_alarm_level }}">
                            @foreach ($fireAlarmLevels as $fireAlarmLevel)
                                <option value="{{ $fireAlarmLevel }}">{{ $fireAlarmLevel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="input-cause-of-incident">Cause of Incident</label>
                        <input class="form-control" type="text" name="input-cause-of-incident"
                            value="{{ $report->cause_of_incident }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="input-estimated-damage">Estimated Damage</label>
                        <div class="row">
                            <div class="col-1">
                                <p class="form-control"><strong>&#8369;</strong></p>
                            </div>
                            <div class="col-11">
                                <input class="form-control" type="text" name="input-estimated-damage"
                                    value="{{ $report->estimated_damage }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="input-reported-by">Reported By</label>
                        <p class="form-control">{{ $report->reportedBy->name }}</p>
                        <input class="form-control" type="hidden" name="input-reported-by"
                            value="{{ $report->reported_by }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="input-description">Description</label>
                        <textarea class="form-control" type="text" name="input-description" rows="10">{{ $report->description }}</textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
