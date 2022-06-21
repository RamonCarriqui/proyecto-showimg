<div id="app">
    <nav id="header-nav" class="navbar navbar-expand-md navbar-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img id="logotipo" src="{{asset('img/Logotipo_PI_header.png')}}" alt="LOGOTIPO">
            </a>
            <button id="perfil-collapse" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
                <!-- Authentication Links -->
                <ul id="drop-down">
                    <ul id="content">
                        <li class="nav-item d-flex align-items-center">
                            <i class='bx bx-id-card' style="font-size: 20px"></i>
                            <a class="nav-link text-dark" href="home/profile">{{ __('Profile') }}</a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <i class='bx bx-log-out' style="font-size: 20px"></i>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </ul>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <!--BARRA BUSQUEDA-->
                <div class="flexsearch">
                    <div class="flexsearch--wrapper">
                        <form id="myForm" class="flexsearch--form">
                            <div class="flexsearch--input-wrapper">
                                <input id="search" class="flexsearch--input" type="text" onclick="this.value = null" placeholder="Buscar...">
                                <button class="flexsearch--submit" type="submit">&#10140;</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item" >
                        <a class='bx bxs-user-circle  d-flex flex-direction-row align-items-center' href="{{ route('login') }}">
                            <span style="font-size: 20px; margin-left:0.5em">Iniciar sesión</span>
                        </a>
                    </li>
                    @endif

                    {{-- Mostrar boton registro --}}
                    {{-- @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif --}}
                    @else
                    <li class="nav-item d-flex align-items-center">
                        <i class='bx bx-id-card' style="font-size: 20px"></i>
                        <a class="nav-link text-dark" href="home/profile">{{ __('Perfil') }}</a>
                    </li>

                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                            {{ __('Cerrar Sesión') }}
                        </a>
                        <i class='bx bx-log-out' style="font-size: 20px"></i>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>