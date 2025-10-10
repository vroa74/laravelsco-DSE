<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RgController;
use App\Http\Controllers\AgeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;



Route::get('/', function () { return view('welcome'); })->name('welcome');

// Rutas de autenticación personalizadas (deben ir antes que las rutas de Fortify)
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/of1', function () { return view('ofi.of1'); })->name('of1');
Route::get('/of2', function () { return view('ofi.of2'); })->name('of2');
Route::get('/of3', function () { return view('ofi.of3'); })->name('of3');
Route::get('/of4', function () { return view('ofi.of4'); })->name('of4');
Route::get('/of5', function () { return view('ofi.of5'); })->name('of5');
Route::get('/of6', function () { return view('ofi.of6'); })->name('of6');
Route::get('/of7', function () { return view('ofi.of7'); })->name('of7');
Route::get('/of8', function () { return view('ofi.of8'); })->name('of8');
Route::get('/of9', function () { return view('ofi.of9'); })->name('of9');
Route::get('/of10', function () { return view('ofi.of10'); })->name('of10');




Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'),  'verified', ])->group(function () {
    // Rutas para el controlador Rg (Reportes Generales) - Solo GET routes para Livewire - TODOS LOS USUARIOS
    Route::resource('rg', RgController::class)->names('rg')->except(['store', 'update']);
    // Rutas para Age - Solo GET routes para Livewire - TODOS LOS USUARIOS
    Route::resource('agen', AgeController::class)->names('agen')->except(['store', 'update']);
    // Rutas para Usuario - Solo GET routes para Livewire - TODOS LOS USUARIOS
    Route::resource('usuario', UsuarioController::class)->names('usuario')->except(['store', 'update']);
    
    // Rutas adicionales para reportes generales - TODOS LOS USUARIOS
    Route::get('/reportesgral', function () {  return view('rg.rg');   })->name('reportgral');
    
    // Otras rutas
    Route::get('/dashboard', function () {  return view('dashboard');   })->name('dashboard');
    Route::get('/catalogos', function () {  return view('catalogos.catalogos');   })->name('catalogos');
    Route::get('/usuarios', function () {  return view('age.people');   })->name('usuarios');
    Route::get('/temp', function () {  return view('temp');   })->name('temp');
    Route::get('/componentes', function () {  return view('comp');   })->name('componentes');
    
    //reportes ----------------------------------------------------------------------------------------------------------------- - TODOS LOS USUARIOS
    Route::get('/reporte-normal/{id}/{tipoReporte}', [ReportsController::class, 'rg_report_1'])->name('reporteNormal');
    Route::get('/reporte-especial/{id}/{tipoReporte}', [ReportsController::class, 'rg_report_2'])->name('reporteEspecial');
    Route::get('/reporte-solicitud/{id}/{tipoReporte}', [ReportsController::class, 'rg_report_3'])->name('reporteSolicitud');
});
