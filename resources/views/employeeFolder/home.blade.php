@extends('layouts.app')

@section('content')
    <div class="row justify-content-between" style="margin-left: 75px; margin-top: 50px; margin-right: 63px;">
        <div id="carouselImageControl" class="carousel slide col-6" data-ride="carousel" style="height: 480px;">
            <ol class="carousel-indicators">
                <li data-target="#carouselImageControl" data-slide-to="0" class="active"></li>
                <li data-target="#carouselImageControl" data-slide-to="1"></li>
                <li data-target="#carouselImageControl" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner shadow" style="border: 2px solid maroon">
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

        <div class="col-5 shadow" style="border: 2px solid maroon">
            <h3 class="text-center my-4">New Approved Reports</h3>
            <table class="table table-bordered table-hover">
                <thead>
                    <th class='text-center'>Baranggay</th>
                    <th class='text-center'>Fire Alarm Level</th>
                    <th class='text-center'>Cause of Incident</th>
                    <th class='text-center'>Estimated Damage</th>
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

    <div class="row justify-content-between"
        style="margin-left: 88px; margin-top: 50px; margin-right: 63px; height: 250px;">
        <div class="col-6 row justify-content-between">
            <div class="col-5 py-3 shadow" style="border: 2px solid maroon">
                <h3 class="text-center">Top 3 Cause of Incident</h3>
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

            <div class="col-5 py-3 shadow" style="border: 2px solid maroon">
                <h3 class="text-center">Top 3 Highest Estimated Damage</h3>
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
        </div>
        <div class="col-4 py-3 shadow" style="border: 2px solid maroon">
            <h3 class="text-center">Contact Information</h3>
            <h5>Facebook: <a
                    href="https://www.facebook.com/barangaylowerbicutan">https://www.facebook.com/barangaylowerbicutan</a>
            </h5>
            <h5>Address: C-6, Lower Bicutan, Taguig, 1632 Metro Manila</h5>
            <h5>Telephone Number: 284-786-640</h5>
        </div>
    </div>
@endsection
