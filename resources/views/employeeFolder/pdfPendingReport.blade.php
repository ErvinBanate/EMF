<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>{{ config('app.name', 'EMS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/inventory.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .pagenum::before {
            content: counter(page);
        }

        header {
            position: fixed;
            top: -50px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;
        }

        .header-item {
            float: left;
        }

        .header-item p {
            font-size: 15px;
        }

        .logo {
            width: 15%;
            height: 15%;
        }

        .description {
            padding-top: 10px;
            text-align: center;
            width: 85%;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;

            /** Extra personal styles **/
            text-align: center;
            line-height: 35px;
        }

        .report-type {
            text-align: center;
        }

        .reports {
            border-collapse: collapse;
            width: 100%;
        }

        .reports td,
        .reports th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 15px;
        }

        .reports th,
        .total {
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: left;
            background-color: #111;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-item logo">
            <img class="rounded mx-auto d-block" src="{{ public_path('Image/output-onlinepngtools.png') }}"
                width="100%">
        </div>
        <div class="header-item description">
            <p>Republic of the Philippines</p>
            <p>Baranggay Lower Bicutaqn Taguig City</p>
            <p>#1 C6 road, Purok 5, Lower Bicutan 1632 Taguig, Philippines</p>
        </div>
    </header>

    <br>
    <br>
    <br>
    <br>
    <br>
    <main id="app">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h2 class='report-type'>Pending Incident Reports</h2>
                    <br>
                    <table class="reports">
                        <thead>
                            <th>Street</th>
                            <th>Block Number</th>
                            <th>House Type</th>
                            <th>Date</th>
                            <th>Fire Alarm Level</th>
                            <th>Cause of Incident</th>
                            <th>Estimated Damage</th>
                            <th>Reported By</th>
                        </thead>
                        <tbody>
                            @foreach ($reports['data'] as $report)
                                <tr>
                                    <td>{{ $report['street'] }}</td>
                                    <td>{{ $report['block_no'] }}</td>
                                    <td>{{ $report['house_type'] }}</td>
                                    <td>{{ $report['date'] }}</td>
                                    <td>{{ $report['fire_alarm_level'] }}</td>
                                    <td>{{ $report['cause_of_incident'] }}</td>
                                    <td><span
                                            style="font-family: DejaVu Sans; sans-serif;">&#8369;{{ number_format($report['estimated_damage']) }}</span>
                                    </td>
                                    <td>{{ $report->reportedBy->name }}</td>
                                </tr>
                            @endforeach
                            <tr class="total">
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><span
                                        style="font-family: DejaVu Sans; sans-serif;">&#8369;{{ number_format($reports['total']) }}</span>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>Date Printed: {{ $current_date }}</p>
        <span class="pagenum"></span>
    </footer>
</body>

</html>
