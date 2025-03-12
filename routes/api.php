<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContratoEmprestimoController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('register', [UserController::class, 'register']);


Route::middleware('auth:api')->group(function () {
    Route::post('/contratos', [ContratoEmprestimoController::class, 'armazenar']);
    Route::get('/contratos', [ContratoEmprestimoController::class, 'listar']);
    Route::patch('/contratos/{id}/status', [ContratoEmprestimoController::class, 'atualizarStatus']);
    Route::delete('/contratos/{id}', [ContratoEmprestimoController::class, 'deletar']);
    Route::get('/clientes/{clienteId}', [ContratoEmprestimoController::class, 'obterCliente']);
});