@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Detailed Fire Incident Reports</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Detailed Fire Incident Reports</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12 pt-3 bg-light shadow">
            <h1 class='text-center'>Fire Incident Reports</h1>
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
                        <tr>
                            <td class='text-center'>{{ $report['baranggay'] }}</td>
                            <td class='text-center'>{{ $report['month'] }} {{ $report['day'] }}, {{ $report['year'] }}</td>
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
                            <td class="text-center"><a href="{{ route('show', $report['id']) }}"><button
                                        class="btn btn-primary">View</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
