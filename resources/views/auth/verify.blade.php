@extends('layouts.header_secundario')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica tu correo.') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un mensaje ha sido enviado a tu bandeja de entrada para confirmar tu correo.') }}
                        </div>
                    @endif

                    {{ __('Antes de acceder, por favor, comprueba tu correo electrónico y haz clic en el link de verificación.') }}
                    {{ __('Si no has recibido el mensaje.') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Haz clic para reenviar.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
