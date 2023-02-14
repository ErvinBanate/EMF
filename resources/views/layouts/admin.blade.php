<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EMS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="{{ asset('css/bootstrap/min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <style>
        #sidebar {
            height: 1075px;
            background-color: maroon;
        }

        main {
            background-color: rgb(252, 242, 222);
        }

        .recentReports {
            max-height: 300px;
            overflow: auto;
            display: inline-block;
        }

        .overflowTable {
            max-height: 800px;
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4">
                <img src="{{ asset('Image/output-onlinepngtools.png') }}" alt="Logo" class="logo">
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="{{ url('/home') }}">Home</a>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Generate Reports</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="{{ url('/summaryReport') }}">Summary Report</a>
                            </li>
                            <li>
                                <a href="#">Detailed Report</a>
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
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" href="#profileLogOut" data-toggle="collapse" aria-expanded="false">
                            Account
                        </a>

                        <ul class="collapse list-unstyled" id="profileLogOut">
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

                <div class="footer">

                </div>
            </div>
        </nav>

        <!-- Page Content  -->
        <main class="p-4 w-100">
            <header style="text-align: right; background-color:maroon; color:white; padding-right:1vh">
                {{-- {{ Auth::user()->name }} ({{ Auth::user()->role->role_name }}) --}}
            </header>
            @yield('content')
        </main>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    </div>
</body>

</html>
