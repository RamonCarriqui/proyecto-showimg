<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ShowImg') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/imagenes.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav id="header-nav" class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img id="logotipo" src="{{asset('img/Logotipo_PI_header.png')}}" alt="LOGOTIPO">
                </a>
                <!--BARRA BUSQUEDA-->
                <div class="flexsearch">
                    <div class="flexsearch--wrapper">
                        <form id="myForm" class="flexsearch--form">
                            <div class="flexsearch--input-wrapper">
                                <input id="search" class="flexsearch--input" type="text" onclick="this.value = null" placeholder="search">
                                <button class="flexsearch--submit" type="submit">&#10140;</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>