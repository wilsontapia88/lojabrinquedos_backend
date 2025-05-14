<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TesteClienteController;
use App\Http\Controllers\EstatisticasController;
use App\Http\Controllers\VendaController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('clientes', ClienteController::class);
    Route::get('/teste-clientes', [TesteClienteController::class, 'index']);

    Route::post('/clientes/{cliente}/vendas', [VendaController::class, 'store']);

    Route::get('/estatisticas/vendas-por-dia', [EstatisticasController::class, 'vendasPorDia']);
    Route::get('/estatisticas/top-clientes', [EstatisticasController::class, 'topClientes']);
});

