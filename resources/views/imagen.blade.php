<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\Auth\ProfileController;

// echo ProfileController::getName();
$emailUser = ProfileController::getEmail();
$nameUser = ProfileController::getName();

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/imagenes.js') }}" defer></script>


    <!-- Scripts Firebase -->
    <script defer src="https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/8.6.1/firebase-firestore.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>

<!-- Al cargar el body se trae todos los comentarios de la imagen seleccionada -->
<body onload="traerInfoImg('{{$id}}', '{{$emailUser}}')"> 
    <header>
        @include('layouts.header_principal')
    </header>
    <main>
        <div id="main-container">
            <div id="imagen">
                <img src="{{$src}}" />
            </div>
            <div class="info-container">
                <div class="propiedades">
                    <ul>
                        <li>
                            <span class="nombre">Nombre:</span>
                            <span class="dato">{{$nombre}}</span>
                        </li>
                        <li>
                            <span class="nombre">Altura:</span>
                            <span class="dato">{{$height}} px</span>
                        </li>
                        <li>
                            <span class="nombre">Anchura: </span>
                            <span class="dato">{{$width}} px</span>
                        </li>
                        <li>
                            <span class="nombre">Color: </span>
                            <span class="dato">{{$avg_color}}</span>
                        </li>
                        <li>
                            <span class="nombre">Autor: </span>
                            <span class="dato">{{$photographer}}</span>
                        </li>
                    </ul>
                </div>
                <div class="botones">
                    <button id="anadirFav" style="display: none;" onclick="anadirFav( '{{$src}}', '{{$nombre}}')">Añadir a favoritos <i class='bx bx-heart'></i></button>
                    <button id="quitarFav" style="display: none;" onclick="quitarFav('{{$id}}', '{{$emailUser}}')">Quitar de favoritos <i class='bx bxs-heart'></i></button>
                    <button onclick="downloadImage('{{$src}}', '{{$nombre}}')">Descargar <i class='bx bx-download'></i></button>
                </div>
            </div>
            <h1 id="sectionComentarios">Comentarios</h1>
            <div id="bloqueComentarios">
                <!-- Maquetación de comentarios -->
                <div id="seccionComentarios">
                    <!--Aqui se maquetan los comentarios a traves de imagenes.js-->
                </div>
                <!-- Enviar comentario -->
                <h2>Enviar comentario</h2>

                <div id="comentarioescrito">
                    <form id="dataForm">
                        <!-- Datos de la imagen -->
                        <input type="hidden" name=id value={{$id}}>
                        <!-- Datos del comentario -->
                        <label to="emailUsuario">
                        </label>
                        <input type="hidden" name="nameUser" value={{$nameUser}}>
                        <input type="hidden" name="emailUsuario" value={{$emailUser}}>
                        <label to="comentUsuario">
                        </label>
                        <textarea rows="4" cols="50" id="comentUsuario" name="comentUsuario"></textarea>
                        <button onclick="enviarComentario()"><i class='bx bx-comment-detail bx-flip-horizontal'></i> Enviar comentario</button>
                    </form>
                </div>
            </div>
        </div>

    </main>
    @include('layouts.footer')
</body>

</html>