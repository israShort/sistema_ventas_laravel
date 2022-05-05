<?php

use App\Http\Controllers\ControladorCliente;
use App\Http\Controllers\ControladorLogin;
use App\Http\Controllers\ControladorRegistro;
use App\Http\Controllers\ControladorSession;
use App\Http\Controllers\ControladorUsuario;
use App\Http\Controllers\ControladorWeb;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('sistema.index');
});

Route::get('/log-out', [ControladorSession::class, 'logout'])->name('sistema.logout');
Route::post('/login', [ControladorLogin::class, 'login']);
Route::post('/sign-up', [ControladorRegistro::class, 'signup']);

Route::get("/obtener-menu-sistema", [ControladorWeb::class, "obtenerMenu"]);
Route::post("/cambiar-clave", [ControladorUsuario::class, "cambiarClave"]);

Route::get("/obtener-cliente", [ControladorCliente::class, "editar"]);
Route::post("/cliente-nuevo", [ControladorCliente::class, "guardar"]);
Route::get("/cargar-grilla-clientes", [ControladorCliente::class, "cargarGrilla"]);
