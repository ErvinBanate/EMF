@extends('layouts.app')

@section('content')
    <!--- Modal --->
    <div class="modal fade" id="newAccomplishmentReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form class="g-3" action="{{ route('createProduct') }}" method="POST">
                            @csrf
                            <div class="row modal-body">
                                <div class="col-md-6">
                                    <label class="form-label" for="input-new-product">Item Name</label>
                                    <input class="form-control" type="text" name="input-new-product" autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="input-new-accounted">Accounted Person</label>
                                    <input class="form-control" type="text" name="input-new-accounted"
                                        autocomplete="off">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-quantity">Quantity</label>
                                    <input class="form-control" type="number" name="input-new-quantity" min="1">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" for="input-new-product-type">Item Type</label>
                                    <select class="form-control" name="input-new-product-type">
                                        <option value="Fire Service Vehicles">Fire Service Vehicles</option>
                                        <option value="Firefigther Tools">Firefighter Tools</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label" for="input-new-acquired">Acquired Date</label>
                                    <input class="form-control" type="date" name="input-new-acquired">
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label" for="input-new-expiration">Expiration Date</label>
                                    <input class="form-control" type="date" name="input-new-expiration">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Create Item</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pagetitle">
        <h3>Fire Rescue Accomplishment Reports</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Fire Rescue Work Accomplishment Reports</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12 pt-3 bg-light shadow">
            <a href="{{ url('createIncidentReport') }}">
                <button type="button" class="btn btn-primary">
                    Create Accomplishment Report
                </button>
            </a>
            <br>
            <br>
            <table class="table table-bordered table-hover table-fixed">
                <thead class="thead-dark">
                    <th class='text-center'>Date</th>
                    <th class='text-center'>Time</th>
                    <th class='text-center'>Task</th>
                    <th class='text-center'>Accomplishment</th>
                    <th class='text-center'>Remarks</th>
                    <th colspan="3"></th>
                </thead>
                <tbody>
                    {{-- @foreach ($reports as $report)
                        @if ($report->reportedBy->name == Auth::user()->name)
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
                        @endif --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
