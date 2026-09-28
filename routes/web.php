<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\RelatorioController;
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
    Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios');

    Route::get('/cadastro', [UsuarioController::class, 'create']);
    Route::post('/cadastro', [UsuarioController::class, 'store']);

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
    Route::get('/clientes/ordens', [ClienteController::class, 'show'])->name('clientes.ordens');

    Route::get('/ordem', [OrdemServicoController::class, 'create']);
    Route::post('/ordem', [OrdemServicoController::class, 'store']);
});
