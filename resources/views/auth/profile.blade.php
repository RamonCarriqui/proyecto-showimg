<?php

use App\Http\Controllers\Auth\ProfileController;

$emailUser = ProfileController::getEmail();
?>

<head>
  <!-- Scripts Firebase -->
  <script defer src="https://www.gstatic.com/firebasejs/8.6.1/firebase-app.js"></script>
  <script defer src="https://www.gstatic.com/firebasejs/8.6.1/firebase-firestore.js"></script>
</head>

<body onload="traerFavs('{{$emailUser}}')">
  <header>
    @extends('layouts.header_profile')
  </header>

  @section('content')

  <div class="container">
    @if(Session::has('message'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      {{ Session::get('message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ $error }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endforeach
    @endif

    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show">
      {{ Session::get('error') }}
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @endif

    <div class="row justify-content-center">
      <div class="col-lg-4">
        <h4>Mi Perfil</code></h5>
          <span class="text-justify mb-3" style="padding-top:-3px;">Actualiza tus datos personales.<br><br>Cuando actualices tu correo tendrás que verificarlo de nuevo, o tu cuenta será eliminada.</span>
      </div>

      <div class="col-lg-8 text-center pt-0">
        <div class="card py-4 mb-5 mt-md-3 bg-white rounded " style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">

          {!! Form::model($user, ['method'=>'PATCH', 'action'=> ['App\Http\Controllers\Auth\ProfileController@update',$user->uid]]) !!}
          {!! Form::open() !!}

          <div class="form-group px-3">
            {!! Form::label('displayName', 'Nombre ',['class'=>'col-12 text-left pl-0']) !!}
            {!! Form::text('displayName', null, ['class'=>' col-md-8 form-control'])!!}

            {!! Form::label('email', 'Email ',['class'=>'pt-3 col-12 text-left pl-0']) !!}
            {!! Form::email('email', null, ['class'=>'col-md-8 form-control'])!!}

          </div>

          <div class="form-group row mb-0 mr-4 pt-4">
            <div class="col-md-8 offset-md-4 text-right">
              {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>

    </div>
    
    <h1 id="sectionFav">Mis Favoritos</h1>
    <div id="imgFav"></div> <!--Aquí se maquetan las imágenes favoritas-->
    <hr>

    <div class="row justify-content-center pt-5">
      <div class="col-lg-4">
        <h4>Actualizar Contraseña</code></h5>
          <span class="text-justify" style="padding-top:-3px;">Crea siempre una contraseña larga y con distintos caracteres para aumentar su seguridad.</span>
      </div>

      <div class="col-lg-8 text-center pt-0">
        <div class="card py-4 mb-5 mt-md-3 bg-white rounded" style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">
          {!! Form::model($user, ['method'=>'PATCH', 'action'=> ['App\Http\Controllers\Auth\ProfileController@update',$user->uid]]) !!}
          {!! Form::open() !!}
          <div class="form-group px-3">
            {!! Form::label('new_password', 'Nueva Contraseña:',['class'=>'col-12 text-left pl-0']) !!}
            {!! Form::password('new_password', ['class'=>'col-md-8 form-control'])!!}
          </div>

          <div class="form-group px-3">
            {!! Form::label('new_confirm_password', 'Confirmar Contraseña:',['class'=>'col-12 text-left pl-0']) !!}
            {!! Form::password('new_confirm_password', ['class'=>'col-md-8 form-control'])!!}
          </div>

          <div class="form-group row mb-0 mr-4 pt-4">
            <div class="col-md-8 offset-md-4 text-right">
              {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>

    </div>

    <div class="border-bottom border-grey"></div>

    <div class="row justify-content-center pt-5">
      <div class="col-lg-4">
        <h4>Eliminar cuenta</code></h5>
          <span class="text-justify" style="padding-top:-3px;">Borra tu cuenta permanentemente.</span>
      </div>

      <div class="col-lg-8 pt-0">
        <div class="card py-4 mb-5 mt-md-3 bg-white rounded align-items-center" style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">
          <div class="text-left px-3">
          </div>

          {!! Form::open(['method'=>'DELETE', 'action' =>['App\Http\Controllers\Auth\ProfileController@destroy',$user->uid]]) !!}
          {!! Form::open() !!}
          <div class="form-group row mb-0 mr-4 pt-4 px-3">
            <div class="col-md-8 offset-l-4 text-center">
              {!! Form::submit('Eliminar Cuenta', ['class'=>'btn btn-danger pl-3']) !!}
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>

    </div>

  </div>

  @endsection
</body>