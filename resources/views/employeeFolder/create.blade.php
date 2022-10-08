@extends('layouts.app')

@section('content')
    @if ($role === 'Employee')
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Fire Incident Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <form class="g-3" method="POST" action="{{ route('store') }}">
                                @csrf
                                <div class="row modal-body">
                                    <div class="col-md-5">
                                        <label class="form-label" for="input-date">Date</label>
                                        <input class="form-control" type="date" name="input-date"
                                            value="{{ old('input-date') }}" required>
                                        @error('input-date')
                                            <span class="invalidFeedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-7">
                                        <label class="form-label" for="input-baranggay">Baranggay</label>
                                        <input class="form-control" type="text" name="input-baranggay"
                                            value="{{ old('input-baranggay') }}" required>
                                        @error('input-baranggay')
                                            <span class="invalidFeedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="input-location">Exact Location</label>
                                        <input class="form-control" type="text" name="input-location"
                                            value="{{ old('input-location') }}" required>
                                        @error('input-location')
                                            <span class="invalidFeedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="input-fire-alarm-level">Fire Alarm Level</label>
                                        <select class="form-control" name="input-fire-alarm-level"
                                            value="{{ old('input-fire-alarm-level') }}" required>
                                            @foreach ($fireAlarmLevels as $fireAlarmLevel)
                                                <option value="{{ $fireAlarmLevel }}">{{ $fireAlarmLevel }}</option>
                                            @endforeach
                                        </select>
                                        @error('input-fire-alarm-level')
                                            <span class="invalidFeedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="input-cause-of-incident">Cause of Incident</label>
                                        <input class="form-control" type="text" name="input-cause-of-incident"
                                            value="{{ old('input-cause-of-incident') }}" required>
                                        @error('input-cause-of-incident')
                                            <span class="invalidFeedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="input-estimated-damage">Estimated Damage</label>
                                        <div class="row">
                                            <div class="col-1">
                                                <p class="form-control"><strong>&#8369;</strong></p>
                                            </div>
                                            <div class="col-10">
                                                <input class="form-control" type="text" name="input-estimated-damage"
                                                    value="{{ old('input-estimated-damage') }}" required>
                                                @error('input-estimated-damage')
                                                    <span class="invalidFeedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="input-reported-by">Reported By</label>
                                        <p class="form-control">{{ Auth::user()->name }}</p>
                                        <input class="form-control" type="hidden" name="input-reported-by"
                                            value="{{ Auth::user()->id }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label" for="input-description">Description</label>
                                        <textarea class="form-control" type="text" name="input-description" rows="4" rows="10" required>{{ old('input-description') }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="submit">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pagetitle">
            <h3>Fire Incident Reports</h3>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Incident Reports</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 bg-light shadow">
                <h1 class='text-center'></h1>
                <br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Create Incident Report
                </button>
                <br>
                <br>
                <table class="table table-bordered table-hover overflowTable">
                    <thead>
                        <th class='text-center'>Baranggay</th>
                        <th class='text-center'>Date</th>
                        <th class='text-center'>Fire Alarm Level</th>
                        <th class='text-center'>Cause of Incident</th>
                        <th class='text-center'>Estimated Damage</th>
                        <th class='text-center'>Reported By</th>
                        <th class='text-center'>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td class='text-center'>{{ $report['baranggay'] }}</td>
                                <td class='text-center'>{{ $report['date'] }}</td>
                                <td class='text-center'>{{ $report['fire_alarm_level'] }}</td>
                                <td class='text-center'>{{ $report['cause_of_incident'] }}</td>
                                <td class='text-center'>&#8369;{{ number_format($report['estimated_damage']) }}
                                </td>
                                <td class='text-center'>{{ $report->reportedBy->name }}</td>
                                @if ($report['is_approved'] == 0 && $report['is_rejected'] == 0)
                                    <td class='text-center'>Pending</td>
                                @elseif ($report['is_approved'] == 1 && $report['is_rejected'] == 0)
                                    <td class='text-center'>Approved</td>
                                @elseif ($report['is_approved'] == 0 && $report['is_rejected'] == 1)
                                    <td class='text-center'>Rejected</td>
                                @else
                                    <td class='text-center'>Data Error</td>
                                @endif
                                @if ($report['is_approved'] == 1 && $report['is_rejected'] == 0)
                                    <td class="text-center" colspan="3"><a
                                            href="{{ route('show', $report['id']) }}"><button
                                                class="btn btn-primary">View</button></a>
                                    </td>
                                @endif
                                @if ($report['is_approved'] == 0 || $report['is_rejected'] == 1)
                                    <td class="text-center"><a href="{{ route('show', $report['id']) }}"><button
                                                class="btn btn-primary">View</button></a>
                                    <td class="text-center"><a href="{{ route('edit', $report['id']) }}"><button
                                                class="btn btn-primary">Edit</button></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('remove', $report['id']) }}"><button
                                                class="btn btn-primary">Remove</button></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif ($role === 'Team Leader')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class='text-center'>Pending Fire Incident Reports</h1>
                <br>
                <table class="table table-bordered table-hover">
                    <thead>
                        <th class='text-center'>Baranggay</th>
                        <th class='text-center'>Date</th>
                        <th class='text-center'>Fire Alarm Level</th>
                        <th class='text-center'>Cause of Incident</th>
                        <th class='text-center'>Estimated Damage</th>
                        <th class='text-center'>Reported By</th>
                        <th class='text-center'>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            @if ($report['is_approved'] == 0 && $report['is_rejected'] == 0)
                                <tr>
                                    <td class='text-center'>{{ $report['baranggay'] }}</td>
                                    <td class='text-center'>{{ $report['date'] }}</td>
                                    <td class='text-center'>{{ $report['fire_alarm_level'] }}</td>
                                    <td class='text-center'>{{ $report['cause_of_incident'] }}</td>
                                    <td class='text-center'>
                                        &#8369;{{ number_format($report['estimated_damage']) }}
                                    </td>
                                    <td class='text-center'>{{ $report->reportedBy->name }}</td>
                                    @if ($report['is_approved'] == 0 && $report['is_rejected'] == 0)
                                        <td class='text-center'>Pending</td>
                                    @else
                                        <td class='text-center'>Data Error</td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{ route('confirmData', $report['id']) }}">
                                            <button class="btn btn-primary">View</button>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
