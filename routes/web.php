<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\PortafolioController;
use App\Livewire\SubirProyecto;
use App\Http\Controllers\Admin\AnalizadorController;
use App\Http\Controllers\Admin\AuthController;

// RUTAS PÚBLICAS EXISTENTES
Route::post("/consultar", [ConsultaController::class, "store"])->name("consultas.store");
Route::get('/', function () { return view('presentacion'); })->name('presentacion');
Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
Route::get('/portafolio', [PortafolioController::class, 'index'])->name('portafolio.index');

// RUTAS DE AUTENTICACIÓN (LOGIN DE ADMINISTRADOR)
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// ZONA PROTEGIDA: Solo administradores autenticados
Route::middleware(['auth'])->group(function () {
    
    // Módulo Portafolio
    Route::get('/admin/subir', function () { return view('admin.subir'); })->name('admin.subir');
    Route::post('/portafolio/guardar', [PortafolioController::class, 'store'])->name('portafolio.store');
    Route::get('/admin/subir-livewire', SubirProyecto::class)->name('admin.subir.livewire');

    // Módulo Analizador Académico IA
    // Nos aseguramos de que termine exactamente en ->name('admin.analizador.index')
    Route::get('/admin/analizador', [AnalizadorController::class, 'index'])->name('admin.analizador.index');
    Route::post('/admin/analizador/procesar', [AnalizadorController::class, 'procesar'])->name('admin.analizador.procesar');
});