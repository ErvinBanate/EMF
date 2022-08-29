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

    <main>
        <div>
            <h2 class="report-type">Fire Incident Report Information</h3>
        </div>
        <div>
            <p>Date Registered: {{ $report->created_at }}</p>
            <p>Reported By: {{ $report->reportedBy->name }}</p>
            <p>Street: {{ $report->street }}</p>
            <p>Block: {{ $report->block_no }}</p>
            <p>House Type: {{ $report->house_type }}</p>
            <p>Date of Incident: {{ $report->date }}</p>
            <p>Estimated Damage: <span
                    style="font-family: DejaVu Sans; sans-serif;">&#8369;{{ number_format($report['estimated_damage']) }}</span>
            </p>
            <p>Cause of Incident: {{ $report->cause_of_incident }}</p>
            <p>Fire Alarm Level: {{ $report->fire_alarm_level }}</p>
            <p>Description:</p>
            <p>{{ $report->description }}</p>
        </div>
    </main>
</body>

</html>
