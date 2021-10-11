<?php

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
    return view('auth.login');
});

Route::get('/agregarcarrera', function () {  //Manda la vista
    return view('administrador.crear');
});

Auth::routes();

Route::get('/admin', [App\Http\Controllers\CarreraController::class, 'index'])->name('admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/agregarcarrera/crear', [App\Http\Controllers\CarreraController::class, 'store'])->name('crearcarrera'); //Se encarga de registrar la carrera

Route::get('/editarcarrera', [App\Http\Controllers\CarreraController::class, 'mostrarPaginaEdicion'])->name('editarcarrera');

Route::post('/editarcarrera/aplicar',[App\Http\Controllers\CarreraController::class, 'update'])->name('aplicareditarcarrera'); //Se encarga de editar la carrera
