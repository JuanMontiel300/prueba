<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/login', [LoginController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [LoginController::class, 'ingresar'])->name('login.ingresar');

Route::get('/admin', [LoginController::class, 'panelAdministrador'])->name('admi.panel');
Route::get('/cliente', [LoginController::class, 'panelCliente'])->name('cliente.panel');


Route::get('/logout', [LoginController::class, 'salir'])->name('logout');

Route::resource('productos', ProductoController::class);
