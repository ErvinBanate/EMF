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
            bottom: 60px;
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
        <table style="width: 100%">
            <tr>
                <td style="width: 50%">For</td>
                <td style="width: 50%">: {{ $fireChief[0]->name }} <br> {{ $fireChief[0]->position }}</td>
            </tr>
            <tr>
                <td style="width: 50%">Subject</td>
                <td style="width: 50%">: Fire Incident Report</td>
            </tr>
            <tr>
                <td style="width: 50%">Date</td>
                <td style="width: 50%">: {{ date('m/d/Y') }}</td>
            </tr>
        </table>
        <hr>
        <table style="width: 100%">
            <tr>
                <td style="width: 50%">Date Registered</td>
                <td style="width: 50%">: {{ $report->created_at }}</td>
            </tr>
            <tr>
                <td style="width: 50%">Reported By</td>
                <td style="width: 50%">: {{ $report->reportedBy->name }}</td>
            </tr>
            <tr>
                <td style="width: 50%">Date of Incident</td>
                <td style="width: 50%">: {{ $report->start_month }}
                    {{ $report->start_day }}, {{ $report->start_year }} - {{ $report->end_month }}
                    {{ $report->end_day }}, {{ $report->end_year }} ({{ $report->time_started }} -
                    {{ $report->time_ended }})</td>
            </tr>
            <tr>
                <td style="width: 50%">Total Damage Cost</td>
                <td style="width: 50%">: <span>&#8369;</span>{{ number_format($report['estimated_damage']) }}</td>
            </tr>
            <tr>
                <td style="width: 50%">Cause of Incident</td>
                <td style="width: 50%">: {{ $report->cause_of_incident }}</td>
            </tr>
            <tr>
                <td style="width: 50%">Total Families Affected</td>
                <td style="width: 50%">: {{ $report->families_affected }}</td>
            </tr>
            <tr>
                <td style="width: 50%">Exact Address</td>
                <td style="width: 50%">: {{ $report->location }}</td>
            </tr>
            <tr>
                <td style="width: 50%">Fire Alarm Level</td>
                <td style="width: 50%">: {{ $report->fire_alarm_level }}</td>
            </tr>
            <br>
            <p>Narative Report:</p>
            <p>{{ $report->description }}</p>
        </table>
        <footer>
            <table style="width: 100%">
                <tr>
                    <td style="width: 50%">
                        <p>
                            <center><u>{{ $fireChief[0]->name }}</u><br>
                                {{ $fireChief[0]->position }}</center>
                        </p>
                    </td>
                    <td style="width: 50%">
                        <p>
                            <center><u>{{ $coordinator[0]->name }}</u><br>
                                {{ $coordinator[0]->position }}</center>
                        </p>
                    </td>
                </tr>
            </table>
        </footer>
    </main>
</body>

</html>
