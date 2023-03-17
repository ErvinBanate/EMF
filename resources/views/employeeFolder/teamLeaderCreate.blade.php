@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Fire Incident Reports</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item "><a href="{{ url('/incidentReport') }}"> Fire Incident Reports</a></li>
                <li class="breadcrumb-item active">Incident Reports</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12 pt-3 bg-light shadow">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            <a href="{{ url('createIncidentReport') }}">
                <button type="button" class="btn btn-primary">
                    Create Incident Report
                </button>
            </a>
            <div class="mb-2" style="display: flex; justify-content: right; padding-right: 2vh">
                <select id="search-category" class="form-control mr-1" style="width: 11%">
                    <option value="baranggay">Baranggay</option>
                    <option value="start_month">Month</option>
                    <option value="start_year">Year</option>
                    <option value="fire_alarm_level">Fire Alarm Level</option>
                    <option value="cause_of_incident">Cause of Incident</option>
                </select>
                <label for="search" class="form-label mr-2 pt-1" style="font-size: 15px">Search:</label>
                <input type="text" class="form-controller" id="search" name="search">
            </div>
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
                    @foreach ($reports as $report)
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
                                            href="{{ route('show', $report['id']) }}"><button class="btn btn-primary"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg></button></a>
                                    </td>
                                @endif
                                @if ($report['is_approved'] == 0 || $report['is_rejected'] == 1)
                                    <td class="text-center"><a href="{{ route('show', $report['id']) }}"><button
                                                class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor" class="bi bi-eye"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg></button></a>
                                    <td class="text-center"><a href="{{ route('edit', $report['id']) }}"><button
                                                class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></button></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('remove', $report['id']) }}"><button class="btn btn-primary"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                </svg></button></a>
                                    </td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript">
            $('#search').on('keyup', function() {
                $value = $(this).val();
                $category = $('#search-category').val();
                // console.log($value);
                if ($value == '') {
                    $.ajax({
                        type: 'get',
                        url: 'https://firimis.puptcapstone.net/incidentReport',
                    });
                } else {
                    $.ajax({
                        type: 'post',
                        url: 'https://firimis.puptcapstone.net/searchTeamLead',
                        data: {
                            'search': $value,
                            'category': $category,
                        },
                        success: function(data) {
                            console.log(data);
                            $('tbody').html(data);
                        }
                    });
                }
            })
        </script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </div>
@endsection
