<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportsController;



Route::get('/', function () { return view('welcome'); })->name('welcome');
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
    Route::get('/dashboard', function () {  return view('dashboard');   })->name('dashboard');
    Route::get('/reportesgral', function () {  return view('rg.rg');   })->name('reportgral');
    Route::get('/reportesgral/add', function () {  return view('rg.add');   })->name('add');
    Route::get('/catalogos', function () {  return view('catalogos.catalogos');   })->name('catalogos');
    Route::get('/usuarios', function () {  return view('usuarios.people');   })->name('usuarios');
    Route::get('/temp', function () {  return view('temp');   })->name('temp');
    Route::get('/componentes', function () {  return view('comp');   })->name('componentes');
    //reportes -----------------------------------------------------------------------------------------------------------------
    Route::get('/reporte-normal/{id}/{tipoReporte}', [ReportsController::class, 'rg_report_1'])->name('reporteNormal');
    Route::get('/reporte-especial/{id}/{tipoReporte}', [ReportsController::class, 'rg_report_2'])->name('reporteEspecial');
    Route::get('/reporte-solicitud/{id}/{tipoReporte}', [ReportsController::class, 'rg_report_3'])->name('reporteSolicitud');
});
