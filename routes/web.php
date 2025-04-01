<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicamentoController;
use Illuminate\Support\Facades\Route;

// Página de inicio: redirige al login
Route::get('/', fn() => redirect()->route('login'));

// Redirigir a la lista de medicamentos después del login
Route::get('/dashboard', fn() => redirect()->route('medicamentos.index'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas protegidas con autenticación
Route::middleware('auth')->group(function () {
    
    // 📌 Gestión del perfil de usuario
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // 📌 Medicamentos: historial y exportación
    Route::prefix('medicamentos')->group(function () {
        Route::get('/historial-descarga', [MedicamentoController::class, 'descargarHistorial'])
            ->name('medicamentos.historial');

        Route::get('/historial-pdf', [MedicamentoController::class, 'generarPDF'])
            ->name('medicamentos.pdf');
    });

    // 📌 CRUD de Medicamentos
    Route::resource('medicamentos', MedicamentoController::class);
});

// Rutas de autenticación
require __DIR__.'/auth.php';
