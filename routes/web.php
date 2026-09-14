<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// LOGIN
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

// ROTAS PROTEGIDAS (exigem login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/cadastro', [UsuarioController::class, 'create']);
    Route::post('/cadastro', [UsuarioController::class, 'store']);

    Route::get('/ordem', [OrdemServicoController::class, 'create']);
    Route::post('/ordem', [OrdemServicoController::class, 'store']);
});
