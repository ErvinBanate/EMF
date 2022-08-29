<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EMS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        #navigation a:hover {
            background-color: crimson;
        }

        #logOut:hover {
            color: white;
        }

        main {
            margin-left: 25px;
            margin-right: 25px;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm" style="background-color: maroon">
            <div class="container" id="navigation">
                @if ($role === 'Employee')
                    <strong>
                        <a class="navbar-brand" href="{{ url('/home') }}" style="color: white">
                            {{-- {{ config('app.name', 'Laravel') }} --}}Home
                        </a>
                        <a class="navbar-brand" href="{{ url('/report') }}" style="color: white">Summary Report</a>
                        <a class="navbar-brand" href="{{ url('/incidentReport') }}" style="color: white">Incident
                            Reports</a>
                    </strong>
                @endif
                @if ($role === 'Team Leader')
                    <strong>
                        <a class="navbar-brand" href="{{ url('/home') }}" style="color: white">
                            {{-- {{ config('app.name', 'Laravel') }} --}}Home
                        </a>
                        <a class="navbar-brand" href="{{ url('/incidentReport') }}" style="color: white">Incident
                            Reports</a>
                        <a class="navbar-brand" href="{{ url('/report') }}" style="color: white">Summary Report</a>
                        <a class="navbar-brand" href="{{ url('/inventory') }}" style="color: white">Inventory</a>
                        <a class="navbar-brand" href="{{ url('/inventoryRequest') }}" style="color: white">Inventory
                            Request</a>
                    </strong>
                @endif
                @if ($role === 'Admin')
                    <strong>
                        <a class="navbar-brand" href="{{ url('/home') }}" style="color: white">
                            {{-- {{ config('app.name', 'Laravel') }} --}}Home
                        </a>
                        <a class="navbar-brand" href="{{ url('/report') }}" style="color: white">Summary Report</a>
                        <a class="navbar-brand" href="{{ url('/register') }}" style="color: white">Register New
                            User</a>
                        <a class="navbar-brand" href="{{ url('/users') }}" style="color: white">Users</a>
                        <a class="navbar-brand" href="{{ url('/adminInventory') }}" style="color: white">Inventory</a>
                        <a class="navbar-brand" href="{{ url('/adminInventoryRequest') }}"
                            style="color: white">Inventory
                            Requests</a>
                    </strong>
                @endif
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <strong>
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                                        style="color: white">
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" id="logOut" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </strong>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>
