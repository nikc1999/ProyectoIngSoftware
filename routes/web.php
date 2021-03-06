<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect('/home');
});

Route::resource('solicitudJDC', App\Http\Controllers\SolicitudJDC::class,['middleware'=>'auth']);

Route::resource('carrera', App\Http\Controllers\CarreraController::class,['middleware'=>'auth']);

Route::resource('contrasena', App\Http\Controllers\Contrase├▒aController::class,['middleware'=>'auth']);

Route::resource('usuario', App\Http\Controllers\UserController::class,['middleware'=>'auth']);

Route::resource('solicitud', App\Http\Controllers\SolicitudController::class,['middleware'=>'auth']);

Route::resource('buscarestudiante',App\Http\Controllers\BuscarEstudiante::class,['middleware'=>'auth']);


Auth::routes();

Route::get('/admin', [App\Http\Controllers\CarreraController::class, 'index'])->name('admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/menucarga',[App\Http\Controllers\UserController::class, 'mostrarCargaMasivaEstudiantes'])->name('menucarga');

Route::post('/cargamasiva',[App\Http\Controllers\UserController::class, 'cargarExcel'])->name('cargamasiva');

Route::post('/agregarusuario/crear', [App\Http\Controllers\UserController::class, 'store'])->name('agregarusuario');  //proceso para generar ,validar y guardar el usuario

Route::get('/gestionarcarreras', [App\Http\Controllers\CarreraController::class, 'mostrarPanelCarreras'])->name('mostrarcarreras');

Route::post('/agregarcarrera/crear', [App\Http\Controllers\CarreraController::class, 'store'])->name('crearcarrera'); //Se encarga de registrar la carrera

Route::get('/agregarcarrera', [App\Http\Controllers\CarreraController::class, 'agregarCarrera'])->name('addcarrera');

Route::post('/editarusuario/habilitar', [App\Http\Controllers\UserController::class, 'habilitarUsuario'])->name('habilitar');

Route::post('/modificar_usuario', [App\Http\Controllers\UserController::class, 'modificarUsuario'])->name('modificar');

Route::post('/modificaradministrador', [App\Http\Controllers\UserController::class, 'modificarAdmin'])->name('editarAdministrador');

Route::post('/editarusuario/restablecerContrasena', [App\Http\Controllers\UserController::class, 'restablecerContrasena'])->name('restablecer');



Route::get('/mostrarsolicitudespendientesjefe', [App\Http\Controllers\UserController::class, 'mostrarSolicitudesPendientesJefe'])->name('mostrarSolicitudesPendientesJefe');

Route::get('/mostrarsolicitudesdfiltrar', [App\Http\Controllers\UserController::class, 'mostrarSolicitudesFiltrar'])->name('mostrarSolicitudesFiltrar');

Route::get('/mostrarsolicitudesdfiltrar2', [App\Http\Controllers\UserController::class, 'mostrarEstadosFiltrar'])->name('mostrarEstadosFiltrar');

Route::post('/buscarestudiante/buscar', [App\Http\Controllers\BuscarEstudiante::class, 'show'])->name('buscarEstudiante');

Route::get('/infoSolicitud', [App\Http\Controllers\UserController::class, 'mostrarInfoSolicitudBoton'])->name('mostrarInfoSolicitudBoton');

Route::get('/estadisticas', [App\Http\Controllers\EstadisiticaController::class, 'showEstadistica'])->name('estadistica');

Route::get('/mostrarestadisticaFiltrada', [App\Http\Controllers\EstadisiticaController::class, 'mostrarEstadisticaFiltrada'])->name('filtrarEstadistica');



