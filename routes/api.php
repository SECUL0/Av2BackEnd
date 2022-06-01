<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ImcController;
use App\Http\Controllers\API\ContaController;
use App\Http\Controllers\API\EnderecoController;
use App\Http\Controllers\API\PersonagemController;
use App\Http\Controllers\API\CoresController;
use App\Http\Controllers\API\ParametrosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('imcs', ImcController::class);
Route::apiResource('contas', ContaController::class);
Route::apiResource('enderecos', EnderecoController::class);
Route::apiResource('personagems', PersonagemController::class);
Route::apiResource('cores', CoresController::class);
Route::apiResource('parametros', ParametrosController::class);