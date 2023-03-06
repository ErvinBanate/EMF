<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FIRIMIS</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        a:hover {
            background-color: lightgray
        }

        .div-background {
            background-repeat: no-repeat;
            background-size: 100%;
        }
    </style>
</head>

<body class="div-background" style="background-image: url(../Image/{{ $backgroundImage[0]->img_url }})">
    <div class="content">
        <main>
            <div class="row justify-content-end mr-1">
                <div class="col-md-3 contents border light-transparent-log-in">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="form-block">
                                <img class="rounded mx-auto d-block" src="{{ asset('Image/' . $logo[0]->img_url) }}"
                                    alt="" width="40%">
                                <div class="text-center mb-4">
                                    <h5>Fire Incident Reports and Inventory Management Information System</h3>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group first">
                                        <label for="email">Email</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group last mb-4">
                                        <label for="password">Password</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="d-flex mb-5 align-items-center">
                                        <label class="control control--checkbox mb-0"><span class="caption">Remember
                                                me</span>
                                            <input type="checkbox" checked="checked" />
                                            <div class="control__indicator"></div>
                                        </label>
                                        <span class="ml-auto"><a href="#" class="forgot-pass">Forgot
                                                Password</a></span>
                                    </div>

                                    <button type="submit" class="btn btn-pill mb-3 text-white btn-block btn-primary">
                                        {{ __('Log In') }}
                                    </button>
                                </form>
                            </div>
                            <br><br><br>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
        
                        <div class="card">
        
                            <div class="card-header">{{ __('Login') }}</div>
        
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
        
                                    <div class="row mb-3">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
        
                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="row mb-3">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
        
                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">
        
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="row mb-3">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }}>
        
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Login') }}
                                            </button>
        
                                            {{-- @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif --}}
            {{-- </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </main>
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
