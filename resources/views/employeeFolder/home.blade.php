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
        <div id="carouselImageControl" class="carousel slide col-6" data-ride="carousel" style="height: 400px;">
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
        </div>

        <div class="col-5 bg-light shadow">
            <h3 class="text-center my-4">New Approved Reports</h3>
            <table class="table table-bordered table-hover recentReports">
                <thead class="thead-dark">
                    <th class='text-center'>Baranggay</th>
                    <th class='text-center'>Fire Alarm Level</th>
                    <th class='text-center'>Cause of Incident</th>
                    <th class='text-center'>Estimated Damage</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        @if ($report['is_approved'] == 1 && $report['is_rejected'] == 0)
                            <tr>
                                <td class='text-center'>{{ $report['baranggay'] }}</td>
                                <td class='text-center'>{{ $report['fire_alarm_level'] }}</td>
                                <td class='text-center'>{{ $report['cause_of_incident'] }}</td>
                                <td class='text-center'>&#8369;{{ number_format($report['estimated_damage']) }}
                                </td>
                                <td class="text-center"><a href="{{ route('show', $report['id']) }}">View</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
