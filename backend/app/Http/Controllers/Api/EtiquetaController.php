<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use App\Models\Etiqueta;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;
use Illuminate\Http\JsonResponse;
use Throwable;

class EtiquetaController extends Controller
{
    /**
     * Listar todas las etiquetas.
     */
    public function index(): JsonResponse
    {
        $etiquetas = Etiqueta::all();

        return response()->json(['data' => $etiquetas], 200);
    }

}
