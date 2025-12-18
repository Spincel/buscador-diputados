<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\DiputadoController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mapa', [MapController::class, 'showMap']);
Route::get('/api/diputados', [DiputadoController::class, 'getDiputados']);
Route::get('/api/diputados/search', [DiputadoController::class, 'search']);
Route::get('/api/diputados-rp', [DiputadoController::class, 'getDiputadosRp']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/diputados/editar', [DiputadoController::class, 'index'])->name('diputados.edit');
    Route::put('/diputados/actualizar', [DiputadoController::class, 'update'])->name('diputados.update');
    Route::post('/diputados/import', [DiputadoController::class, 'import'])->name('diputados.import');
});

require __DIR__.'/auth.php';