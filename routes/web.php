<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () { // Página principal
    return view('index');
});

Auth::routes(); // Rutas de autentificación que dirige a la vista login y registro

// No puedes ver la vista detallada de la imagen si no estas logueado(redirecciona al login)
Route::match(array('GET', 'POST'), '/imagen', [App\Http\Controllers\ImageController::class, 'enviarPhoto'])->middleware('user', 'fireauth'); // Middleware comprueba que estás autentificado para poder acceder

// Route::post('/enviarComentario', [App\Http\Controllers\ImageController::class, 'enviarComentario']); // Envio de comentarios

// Rutas usuario
Route::get('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify_email'])->middleware('fireauth');

Route::post('login/{provider}/callback', 'Auth\LoginController@handleCallback');

Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class)->middleware('user', 'fireauth');

Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);

Route::resource('/img', App\Http\Controllers\ImageController::class);
