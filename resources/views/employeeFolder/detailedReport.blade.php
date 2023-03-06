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
                    <th class='text-center'>Action</th>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        @if ($report['is_approved'] == 1 && $report['is_rejected'] == 0)
                            <tr>
                                <td class='text-center'>{{ $report['baranggay'] }}</td>
                                <td class='text-center'>{{ $report['start_month'] }} {{ $report['start_day'] }},
                                    {{ $report['start_year'] }}
                                </td>
                                <td class='text-center'>{{ $report['fire_alarm_level'] }}</td>
                                <td class='text-center'>{{ $report['cause_of_incident'] }}</td>
                                <td class='text-center'>&#8369;{{ number_format($report['estimated_damage']) }}
                                </td>
                                <td class='text-center'>{{ $report->reportedBy->name }}</td>
                                <td class='text-center'>Approved</td>
                                <td class="text-center"><a href="{{ route('show', $report['id']) }}"><button
                                            class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg></button></a>
                                </td>
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
                        url: 'http://localhost:8000/incidentReport',
                    });
                } else {
                    $.ajax({
                        type: 'post',
                        url: 'http://localhost:8000/searchDetailed',
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
