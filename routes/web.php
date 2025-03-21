<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicamentoController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

// Página de inicio
Route::get('/', function () {
    return redirect()->route('login');
});
// ✅ Ruta de prueba para generar un PDF
Route::get('/test-pdf', function () {
    $pdf = PDF::loadHTML('<h1>Hola, Laravel DomPDF</h1>');
    return $pdf->stream('test.pdf');
});

// Ruta del dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas para autenticación
Route::middleware('auth')->group(function () {
    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Ruta para descargar el historial de medicamentos en CSV (antes del resource)
    Route::get('/medicamentos/historial-descarga', [MedicamentoController::class, 'descargarHistorial'])
        ->name('medicamentos.historial');

    // ✅ Ruta para generar el PDF del historial de medicamentos
    Route::get('/medicamentos/historial-pdf', [MedicamentoController::class, 'generarPDF'])
        ->name('medicamentos.pdf');

    // ✅ CRUD de Medicamentos
    Route::resource('medicamentos', MedicamentoController::class);
});

// Archivo de rutas de autenticación
require __DIR__.'/auth.php';
