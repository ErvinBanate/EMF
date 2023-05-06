@extends('layouts.app')

@section('content')
    <!--- Modal --->
    <div class="modal fade" id="newAccomplishmentReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Accomplishment Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <form class="g-3" action="{{ route('createAccomplishment') }}" method="POST">
                            @csrf
                            <div class="row modal-body">
                                <div class="col-md-6">
                                    <label class="form-label" for="input-new-product">Task <span
                                            style="color:red">*</span></label>
                                    <input class="form-control" type="text" name="input-task" autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="input-new-accounted">Accomplishments <span
                                            style="color:red">*</span></label>
                                    <select class="form-control" name="input-accomplishment">
                                        <option value="Done Responding">Done Responding</option>
                                        <option value="Done Responding">Done Monitoring</option>
                                        <option value="Done Responding">Done Flushing</option>
                                        <option value="Done Responding">Done Participating</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-product-type">Month <span
                                            style="color:red">*</span></label>
                                    <select class="form-control" name="input-month">
                                        @foreach ($months as $month)
                                            <option value="{{ $month }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-product-type">Day <span
                                            style="color:red">*</span></label>
                                    <select class="form-control" name="input-day">
                                        @for ($day = 1; $day <= 31; $day++)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-product-type">Year <span
                                            style="color:red">*</span></label>
                                    <select class="form-control" name="input-year">
                                        @for ($year = 1950; $year <= 2050; $year++)
                                            @if ($year === now()->year)
                                                <option value="{{ $year }}" selected>{{ $year }}
                                                </option>
                                            @else
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-quantity">Time Started <span
                                            style="color:red">*</span></label>
                                    <input class="form-control" type="time" name="input-time-started">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-quantity">Time Ended <span
                                            style="color:red">*</span></label>
                                    <input class="form-control" type="time" name="input-time-ended">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="input-new-expiration">Remarks</label>
                                    <input class="form-control" type="text" name="input-remarks">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Create Report</button>
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newAccomplishmentReport">
                Create Accomplishment Report
            </button>
            <br>
            <br>
            <table class="table table-bordered table-hover table-fixed">
                <thead class="thead-dark">
                    <th class='text-center'>Date</th>
                    <th class='text-center'>Time</th>
                    <th class='text-center'>Task</th>
                    <th class='text-center'>Accomplishment</th>
                    <th class='text-center'>Remarks</th>
                    <th class="text-center">Actions</th>
                </thead>
                <tbody>
                    @foreach ($accomplishments as $accomplishment)
                        <tr>
                            <td class='text-center'>{{ $accomplishment['month'] }} {{ $accomplishment['day'] }},
                                {{ $accomplishment['year'] }}</td>
                            <td class='text-center'>
                                {{ Carbon\Carbon::parse($accomplishment['time_started'])->format('H:i') }} -
                                {{ Carbon\Carbon::parse($accomplishment['time_ended'])->format('H:i') }}</td>
                            <td class='text-center'>{{ $accomplishment['task'] }}</td>
                            <td class='text-center'>{{ $accomplishment['accomplishments'] }}</td>
                            <td class='text-center'>{{ $accomplishment['remarks'] }}
                            </td>
                            <td class="text-center"><a href="{{ route('removeAccomplishment', $accomplishment['id']) }}"
                                    class="btn btn-primary"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
