<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostulantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/', [IndexController::class, 'index']);

Route::post('/apply', [PostulantController::class, 'store']);




Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PostulantController::class, 'index'])->name("postulants.index");
    Route::get('/postulant/{postulant}', [PostulantController::class, 'show'])->name("postulants.show");
    Route::delete('/postulant/{postulant}', [PostulantController::class, 'destroy'])->name("postulants.destroy");
    
});

// require __DIR__.'/auth.php';
