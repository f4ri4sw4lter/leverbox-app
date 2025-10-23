<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TareaController;
use App\Http\Controllers\Api\EtiquetaController;

/*Route::apiResource('tareas', TareaController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tareas', TareaController::class)->only(['store', 'update', 'destroy']);
});*/

Route::apiResource('tareas', TareaController::class);
Route::apiResource('etiquetas', EtiquetaController::class);