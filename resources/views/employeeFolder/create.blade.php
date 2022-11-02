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
                            <form class="g-3" action="{{ route('store') }}" method="POST">
                                @csrf
                                <div class="row modal-body">
                                    <div class="col-md-4">
                                        <label class="form-label" for="input-month">Month</label>
                                        <select class="form-control" name="input-month" value="{{ old('input-month') }}">
                                            @foreach ($months as $month)
                                                <option value="{{ $month }}">{{ $month }}</option>
                                            @endforeach
                                        </select>
                                        @error('input-month')
                                            <span class="invalidFeedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="input-day">Day</label>
                                        <select class="form-control" name="input-day" value="{{ old('input-day') }}">
                                            @for ($day = 1; $day <= 31; $day++)
                                                <option value="{{ $day }}">{{ $day }}</option>
                                            @endfor
                                        </select>
                                        @error('input-day')
                                            <span class="invalidFeedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="input-year">Year</label>
                                        <select class="form-control" name="input-year" value="{{ old('input-day') }}">
                                            @for ($year = 2050; $year >= 1950; $year--)
                                                @if ($year === now()->year)
                                                    <option value="{{ $year }}" selected>{{ $year }}
                                                    </option>
                                                @else
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                        @error('input-year')
                                            <span class="invalidFeedback" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
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
                                    {{-- <div class="col-md-12 mt-3">
                                        <label for="formFile" class="form-label">Evidence</label>
                                        <input class="form-control" type="file" id="formFile" name="input-evidence">
                                    </div> --}}
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
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Fire Incident Reports</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 pt-3 bg-light shadow">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Create Incident Report
                </button>
                <br>
                <br>
                <table class="table table-bordered table-hover overflowTable">
                    <thead class="thead-dark">
                        <th class='text-center'>Baranggay</th>
                        <th class='text-center'>Date of Incident</th>
                        <th class='text-center'>Fire Alarm Level</th>
                        <th class='text-center'>Cause of Incident</th>
                        <th class='text-center'>Estimated Damage</th>
                        <th class='text-center'>Reported By</th>
                        <th class='text-center'>Status</th>
                        <th colspan="3"></th>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td class='text-center'>{{ $report['baranggay'] }}</td>
                                <td class='text-center'>{{ $report['month'] }} {{ $report['day'] }},
                                    {{ $report['year'] }}</td>
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
        <div class="pagetitle">
            <h3>Pending Fire Incident Reports</h3>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Incident Reports</li>
                </ol>
            </nav>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 pt-4 bg-light shadow">
                <table class="table table-bordered table-hover overflowTable">
                    <thead class="thead-dark">
                        <th class='text-center'>Baranggay</th>
                        <th class='text-center'>Date</th>
                        <th class='text-center'>Fire Alarm Level</th>
                        <th class='text-center'>Cause of Incident</th>
                        <th class='text-center'>Estimated Damage</th>
                        <th class='text-center'>Reported By</th>
                        <th class='text-center'>Status</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            @if ($report['is_approved'] == 0 && $report['is_rejected'] == 0)
                                <tr>
                                    <td class='text-center'>{{ $report['baranggay'] }}</td>
                                    <td class='text-center'>{{ $report['month'] }} {{ $report['day'] }},
                                        {{ $report['year'] }}</td>
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
