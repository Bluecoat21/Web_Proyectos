<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\PortafolioController;
use App\Livewire\SubirProyecto;

Route::post("/consultar", [ConsultaController::class, "store"])->name("consultas.store");

Route::get('/', function () { return view('presentacion'); })->name('presentacion');

Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');

Route::get('/portafolio', [PortafolioController::class, 'index'])->name('portafolio.index');

Route::get('/admin/subir', function () { return view('admin.subir');
})->name('admin.subir');

Route::post('/portafolio/guardar', [PortafolioController::class, 'store'])->name('portafolio.store');

Route::get('/admin/subir', SubirProyecto::class)->name('admin.subir');
