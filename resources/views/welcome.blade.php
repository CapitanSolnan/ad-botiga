<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-white">
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/"
                class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Rincón Sabor</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item px-1"><a href="{{ url('/producte') }}" class="btn btn-outline-primary">Productes</a>
                </li>

                @if (Route::has('login'))
                    @auth
                        <li class="nav-item px-1">
                            <a href="{{ url('/carrito') }}" class="btn btn-outline-primary">Carrito</a>
                        </li>
                    @else
                        <li class="nav-item px-1">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item px-1">
                                <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </header>
    </div>

    <div class="container">
        <div class="p-5 text-center rounded-3">
            <img src="{{ asset('img/ChatGPT Image 12 mar 2026, 13_34_14.png') }}" width="500">
        </div>
    </div>

</body>

</html>