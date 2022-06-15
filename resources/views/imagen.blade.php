<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\Auth\ProfileController;

// echo ProfileController::getName();
$emailUser = ProfileController::getEmail();
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

<body>
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
                    <button>Añadir a favoritos <i class='bx bx-heart'></i></button>
                    <button onclick="downloadImage('{{$src}}', '{{$nombre}}')">Descargar <i class='bx bx-download'></i></button>
                </div>
            </div>
            <h1 id="recomendados">Comentarios</h1>
            <!-- Maquetación de comentarios -->
            <div>
                <?php

                // $docRef = $db->collection('samples/php/cities')->document($id);
                // $snapshot = $docRef->snapshot();

                // if ($snapshot->exists()) {
                //     printf('Document data:' . PHP_EOL);
                //     print_r($snapshot->data());
                // } else {
                //     printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
                // }
                ?>


            </div>
            <!-- Enviar comentario -->
            <h2>Enviar comentario</h2>
            <form id="dataForm">
                <!-- Datos de la imagen -->
                <input type="hidden" name=id value={{$id}}>
                <!-- Datos del comentario -->
                <label to="emailUsuario">
                    <h6>Email de usuario:</h6> {{$emailUser}}
                </label>
                <input type="hidden" name="emailUsuario" value={{$emailUser}}> <!-- El readonly hace que el usuario no pueda modificarlo, solo leer -->
                <label to="comentUsuario">
                    <h5>Comentario:</h5>
                </label>
                <textarea rows="4" cols="50" id="comentUsuario" name="comentUsuario"></textarea>
            </form>
            <button onclick="enviarComentario()">asdasdasd <i class='bx bx-download'></i></button>
        </div>

    </main>
    @include('layouts.footer')
</body>

</html>