<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TareaController;

Route::apiResource('tareas', TareaController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tareas', TareaController::class)->only(['store', 'update', 'destroy']);
});