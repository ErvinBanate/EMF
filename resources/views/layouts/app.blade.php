<!doctype html>
<html lang="en">

<head>
    <title>FIRIMIS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{ asset('css/bootstrap/min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <style>
        #sidebar {
            height: 100vh;
            background-color: maroon;
        }

        main {
            background-color: rgb(252, 242, 222);
            max-height: 100vh
        }

        .recentReports {
            max-height: 32vh;
            overflow: auto;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4">
                <img src="{{ asset('Image/output-onlinepngtools.png') }}" alt="Logo" class="logo">
                <ul class="list-unstyled components mb-5">
                    @switch($role)
                        @case('Employee')
                            <li>
                                <a href="{{ url('/home') }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ url('/incidentReport') }}">Fire Incident Reports</a>
                            </li>
                            <li>
                                <a href="#reportSubMenu" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle">Generate Reports</a>
                                <ul class="collapse list-unstyled" id="reportSubMenu">
                                    <li>
                                        <a href="{{ url('/summaryReport') }}">Summary Report</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/detailedReport') }}">Detailed Report</a>
                                    </li>
                                </ul>
                            </li>
                        @break

                        @case('Team Leader')
                            <li>
                                <a href="{{ url('/home') }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ url('/incidentReport') }}">Manage Fire Incident Reports</a>
                            </li>
                            <li>
                                <a href="#reportSubMenu" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle">Generate Reports</a>
                                <ul class="collapse list-unstyled" id="reportSubMenu">
                                    <li>
                                        <a href="{{ url('/summaryReport') }}">Summary Report</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/detailedReport') }}">Detailed Report</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#inventorySubMenu" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle">Inventory Management</a>
                                <ul class="collapse list-unstyled" id="inventorySubMenu">
                                    <li>
                                        <a href="{{ url('/inventory') }}">Inventory List</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/inventoryRequest') }}">Request List</a>
                                    </li>
                                </ul>
                            </li>
                        @break

                        @case('Admin')
                            <li>
                                <a href="{{ url('/home') }}">Home</a>
                            </li>
                            <li>
                                <a href="#reportSubMenu" data-toggle="collapse" aria-expanded="false"
                                    class="dropdown-toggle">Generate Reports</a>
                                <ul class="collapse list-unstyled" id="reportSubMenu">
                                    <li>
                                        <a href="{{ url('/summaryReport') }}">Summary Report</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/detailedReport') }}">Detailed Report</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ url('/register') }}">Register New User</a>
                            </li>
                            <li>
                                <a href="{{ url('/users') }}">List of Users</a>
                            </li>
                            <li>
                                <a href="{{ url('/adminInventory') }}">Inventory Management</a>
                            </li>
                            <li>
                                <a href="{{ url('/adminInventoryRequest') }}">Inventory Requests</a>
                            </li>
                        @break

                        @default
                    @endswitch
                    <li>
                        <a href="#userSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            Account
                        </a>
                        <ul class="collapse list-unstyled" id="userSubMenu">
                            <li>
                                <a href="{{ route('account') }}">Account Details</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page Content  -->
        <main class="p-4 w-100">
            <header style="text-align: right; background-color:maroon; color:white; padding-right:1vh">
                {{ Auth::user()->name }} ({{ $role }})</header>
            @yield('content')
        </main>
    </div>
</body>

</html>
