@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        @if ($role === 'Employee')
            <h3>Fire Incident Reports</h3>
        @elseif ($role === 'Team Leader')
            <h3>Pending Fire Incident Reports</h3>
        @endif

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Fire Incident Reports</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12 pt-3 bg-light shadow">
            @if ($role === 'Employee')
                <a href="{{ url('createIncidentReport') }}">
                    <button type="button" class="btn btn-primary">
                        Create Incident Report
                    </button>
                </a>
            @elseif ($role === 'Team Leader')
                <a href="{{ url('/teamLeadCreate') }}">
                    <button type="button" class="btn btn-primary">
                        Incident Reports
                    </button>
                </a>
            @endif
            <br>
            <br>
            @if ($role === 'Employee')
                <table class="table table-bordered table-hover table-fixed">
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
                        <div class="overflowTable">
                            @foreach ($reports as $report)
                                <tr>
                                    <td class='text-center'>{{ $report['baranggay'] }}</td>
                                    <td class='text-center'>{{ $report['start_month'] }} {{ $report['start_day'] }},
                                        {{ $report['start_year'] }}</td>
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
                        </div>
                    </tbody>
                </table>
            @elseif ($role === 'Team Leader')
                <table class="table table-bordered table-hover table-fixed">
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
                            @if (Auth::user()->name !== $report->reportedBy->name)
                                @if ($report['is_approved'] == 0 && $report['is_rejected'] == 0)
                                    <tr>
                                        <td class='text-center'>{{ $report['baranggay'] }}</td>
                                        <td class='text-center'>{{ $report['start_month'] }} {{ $report['start_day'] }},
                                            {{ $report['start_year'] }}</td>
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
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
