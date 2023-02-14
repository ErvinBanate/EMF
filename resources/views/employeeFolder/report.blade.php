@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h3>Summary Report</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item">Generate Reports</li>
                <li class="breadcrumb-item active">Summary Report</li>
            </ol>
        </nav>
    </div>
    <div class="container bg-light shadow py-4">
        <div class="row justify-content-center pb-3 my-3">
            <div class="col-6">
                <canvas id="reports"></canvas>
            </div>
            <div class="col-6 mb-5">
                <canvas id="coi"></canvas>
            </div>
            <div class="col-6">
                <canvas id="hed"></canvas>
            </div>
            {{-- <div class="col-md-3">
                <h5>Approved Reports: {{ $approved }}</h5>
            </div>
            <div class="col-md-3">
                <h5>Pending Reports: {{ $pending }}</h5>
            </div>
            <div class="col-md-3">
                <h5>Rejected Reports: {{ $rejected }}</h5>
            </div>
            <div class="col-md-3">
                <h5>Total Annual Reports: {{ $all }}</h5>
            </div> --}}
        </div>
        {{-- <div class="row justify-content-around my-3">
            <div class="row border col-md-5 py-4">
                <div class="col-md-12">
                    <h4 class="text-center"><strong>Top 3 Highest Rate of Cause of Incident</strong></h5>
                </div>
                <div class="d-flex justify-content-center">
                    <ul>
                        @foreach ($topCOI as $topCause)
                            <li>
                                <h5>{{ $topCause->cause_of_incident }}: {{ $topCause->total }}</h5>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row border col-md-5 py-4">
                <div class="col-md-12">
                    <h4 class="text-center"><strong>Top 3 Highest Estimated Damage</strong></h5>
                </div>
                <div class="d-flex justify-content-center">
                    <ul>
                        @foreach ($lowStreets as $lowStreet)
                            <li>
                                <h5 class="text-center">&#8369;{{ number_format($lowStreet->estimated_damage) }}</h5>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> --}}
        <script>
            const displayReports = document.getElementById('reports');
            const displayCOI = document.getElementById('coi');
            const displayHED = document.getElementById('hed');
            const coi = {!! json_encode($topCOI->toArray(), JSON_HEX_TAG) !!}
            const hed = {!! json_encode($lowStreets->toArray(), JSON_HEX_TAG) !!}
            const approved = "{{ $approved }}";
            const pending = "{{ $pending }}";
            const rejected = "{{ $rejected }}";
            const all = "{{ $all }}";

            // if (month.length == 0) {
            //     displayMonth.innerHTML = 'No Data Found';
            // } else {
            new Chart(displayReports, {
                type: 'line',
                data: {
                    labels: ['Approved Reports', 'Pending Reports', 'Rejected Reports', 'Total Reports'],
                    datasets: [{
                        label: 'No. of Reports',
                        data: [approved, pending, rejected, all],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(255, 159, 64, 0.5)',
                            'rgba(255, 205, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
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
            // }

            // if (baranggay.length == 0) {
            //     displayBaranggay.innerHTML = 'No Data Found';
            // } else {
            new Chart(displayCOI, {
                type: 'bar',
                data: {
                    labels: [coi[0].cause_of_incident, coi[1].cause_of_incident, coi[2].cause_of_incident],
                    datasets: [{
                        label: 'Top 3 Causes of Reported Fire Incident Cases',
                        data: [coi[0].total, coi[1].total, coi[2].total],
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
            // }

            // if (baranggay.length == 0) {
            //     displayBaranggay.innerHTML = 'No Data Found';
            // } else {
            new Chart(displayHED, {
                type: 'bar',
                data: {
                    labels: ['1', '2', '3'],
                    datasets: [{
                        label: 'Top 3 Highest Estimated Damage in the Reported Fire Incident Cases',
                        data: [hed[2].estimated_damage, hed[1].estimated_damage, hed[0].estimated_damage],
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
            // }
        </script>
    </div>
@endsection
