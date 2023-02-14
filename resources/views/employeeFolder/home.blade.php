@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Dashboard</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-between" style="margin-left: 2%; margin-top: 2%; margin-right: 2%;">
        {{-- <div id="carouselImageControl" class="carousel slide col-6" data-ride="carousel" style="height: 400px;">
            <ol class="carousel-indicators">
                <li data-target="#carouselImageControl" data-slide-to="0" class="active"></li>
                <li data-target="#carouselImageControl" data-slide-to="1"></li>
                <li data-target="#carouselImageControl" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner shadow">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('Image/imageBanner6.jpg') }}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('Image/imageBanner5.jpg') }}" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('Image/imageBanner4.jpg') }}" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselImageControl" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselImageControl" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div> --}}
        <div class="col-5">
            <canvas class="border bg-light p-2 my-5" id="baranggay"></canvas>
            <canvas class="border bg-light p-2 my-5" id="month"></canvas>
        </div>

        @switch($role)
            @case('Team Leader')
                <div class="col-5 shadow" style="background-color: #e9ecef">
                    <h3 class="my-4">New Pending Reports ({{ count($reportsTeamLeader) }})</h3>
                    <div style="max-height: 68vh; overflow: auto; display: inline-block; width: 100%">
                        @foreach ($reportsTeamLeader as $report)
                            <div class="p-2 mb-3 bg-light" style="border-left: 3px solid maroon">
                                <h3>{{ $report['baranggay'] }}, {{ $report['start_month'] }} {{ $report['start_day'] }},
                                    {{ $report['start_year'] }}
                                </h3>
                                <p class="text-dark">Report by: {{ $report->reportedBy->name }}, Created At:
                                    {{ $report['created_at'] }}</p>
                                <p class="text-dark">Fire Alarm Level: {{ $report['fire_alarm_level'] }}, Estimated Damage: &#8369;
                                    {{ number_format($report['estimated_damage']) }}</p>
                                <a href="{{ route('show', $report['id']) }}"
                                    style="display: flex; justify-content: right; padding-right: 2vh"><button
                                        class="btn btn-primary">Review</button></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @break

            @case('Employee')
                <div class="col-5 shadow" style="background-color: #e9ecef">
                    <h3 class="my-4">Pending Reports ({{ count($reportsEmployee) }})</h3>
                    <div style="max-height: 68vh; overflow: auto; display: inline-block; width: 100%">
                        @foreach ($reportsEmployee as $report)
                            @if ($report->is_approved == 0 && $report->is_rejected == 0)
                                <div class="p-2 mb-3 bg-light" style="border-left: 3px solid maroon">
                                    <h3>{{ $report['baranggay'] }}, {{ $report['start_month'] }} {{ $report['start_day'] }},
                                        {{ $report['start_year'] }}
                                    </h3>
                                    <p class="text-dark">Report by: {{ $report->reportedBy->name }}, Created At:
                                        {{ $report['created_at'] }}</p>
                                    <p class="text-dark">Fire Alarm Level: {{ $report['fire_alarm_level'] }}, Estimated Damage:
                                        &#8369;
                                        {{ number_format($report['estimated_damage']) }}</p>
                                    <a href="{{ route('show', $report['id']) }}"
                                        style="display: flex; justify-content: right; padding-right: 2vh"><button
                                            class="btn btn-primary">Review</button></a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @break

            @case('Admin')
                <div class="col-5 shadow" style="background-color: #e9ecef">
                    <h3 class="my-4">Approved Reports ({{ count($reportsAdmin) }})</h3>
                    <div style="max-height: 68vh; overflow: auto; display: inline-block; width: 100%">
                        @foreach ($reportsAdmin as $report)
                            <div class="p-2 mb-3 bg-light" style="border-left: 3px solid maroon">
                                <h3>{{ $report['baranggay'] }}, {{ $report['start_month'] }} {{ $report['start_day'] }},
                                    {{ $report['start_year'] }}
                                </h3>
                                <p class="text-dark">Report by: {{ $report->reportedBy->name }}, Created At:
                                    {{ $report['created_at'] }}</p>
                                <p class="text-dark">Fire Alarm Level: {{ $report['fire_alarm_level'] }}, Estimated Damage:
                                    &#8369;
                                    {{ number_format($report['estimated_damage']) }}</p>
                                <a href="{{ route('show', $report['id']) }}"
                                    style="display: flex; justify-content: right; padding-right: 2vh"><button
                                        class="btn btn-primary">View</button></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @break

            @default
        @endswitch

        <script>
            const displayBaranggay = document.getElementById('baranggay');
            const displayMonth = document.getElementById('month');
            const month = {!! json_encode($months->toArray(), JSON_HEX_TAG) !!}
            const baranggay = {!! json_encode($baranggays->toArray(), JSON_HEX_TAG) !!}

            if (month.length == 0) {
                displayMonth.innerHTML = 'No Data Found';
            } else {
                new Chart(displayMonth, {
                    type: 'line',
                    data: {
                        labels: [month[0].start_month, month[1].start_month, month[2].start_month, month[3].start_month,
                            month[4].start_month
                        ],
                        datasets: [{
                            label: 'Top 5 Months with Fire Incident Cases',
                            data: [month[0].total, month[1].total, month[2].total, month[3].total, month[4]
                                .total
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(255, 159, 64, 0.5)',
                                'rgba(255, 205, 86, 0.5)',
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                            ],
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            if (baranggay.length == 0) {
                displayBaranggay.innerHTML = 'No Data Found';
            } else {
                new Chart(displayBaranggay, {
                    type: 'bar',
                    data: {
                        labels: [baranggay[0].baranggay, baranggay[1].baranggay, baranggay[2].baranggay],
                        datasets: [{
                            label: 'Top 3 Highest Baranggay with Reported Fire Incident Cases',
                            data: [baranggay[0].total, baranggay[1].total, baranggay[2].total],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(255, 159, 64, 0.5)',
                                'rgba(255, 205, 86, 0.5)',
                            ],
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                            ],
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        </script>
    </div>
@endsection
