<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsuariosController;

//Rutas que solo va a tener el administrador.
Route::resource('usuarios', UsuariosController::class)-> names('admin.usuarios');
