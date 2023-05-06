@extends('layouts.app')

@section('content')
    {{-- <div classs="container p-5">
        <div class="row no-gutters">
            <div class="col-lg-5 col-md-12 ml-auto">
                @if ({{ Session::has('success') }})
                    <div class="alert alert-success shadow" role="alert" style="border-left:rgb(21, 87, 36) 5px solid; border-radius: 0px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="True" style="color:rgb(21, 87, 36)">&times;</span>
                        </button>
                        <div class="row">
                            <i class="fa-solid fa-shield-check"></i>
                            <p style="font-size:18px" class="mb-0 font-weight-light"><b class="mr-1">Success!</b>This example text in a custom alert.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div> --}}
    <div class="pagetitle">
        @if ($role === 'Employee')
            <h3>Removed Fire Incident Reports</h3>
        @elseif ($role === 'Team Leader')
            <h3>Pending Fire Incident Reports</h3>
        @endif
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Removed Fire Incident Reports</li>
            </ol>
        </nav>
    </div>
    @if (Session::has('success'))
        <div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert'>
                <i class='fa fa-times'></i>
            </button>
            <strong>Success ! {{ Session::get('success') }}</strong>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-12 pt-3 bg-light shadow">
            <a href="{{ url('/incidentReport') }}" class="btn btn-secondary">Back</a>
            @if ($role === 'Employee')
                <table class="table table-bordered table-hover table-fixed mt-3">
                    <thead class="thead-dark">
                        <th class='text-center'>Baranggay</th>
                        <th class='text-center'>Date of Incident</th>
                        <th class='text-center'>Fire Alarm Level</th>
                        <th class='text-center'>Cause of Incident</th>
                        <th class='text-center'>Estimated Damage</th>
                        <th class='text-center'>Reported By</th>
                        <th class='text-center'>Deleted At</th>
                        <th class='text-center'>Action</th>
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
                                    <td class='text-center'>{{ $report->deleted_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('restore', $report->id) }}" class="btn btn-primary">Restore</a>
                                    </td>
                                </tr>
                            @endforeach
                        </div>
                    </tbody>
                </table>
            @endif
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
                        url: 'httponip  ; s://firimis.puptcapstone.net/incidentReport',
                    });
                } else {
                    $.ajax({
                        type: 'post',
                        url: 'https://firimis.puptcapstone.net/search',
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
