<?php

namespace App\Http\Controllers\Api;

use App\Models\Tarea;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;
use Illuminate\Http\JsonResponse;

use Throwable;
use Carbon\Carbon;

class TareaController extends Controller
{

    
    /**
     * Mostrar todas las tareas con sus prioridades y etiquetas.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $tareas = Tarea::with(['prioridad', 'etiquetas'])->get();
            return response()->json(['data' => $tareas], 200);
        } catch (Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }

    }


    /**
     * Almacena una nueva tarea con sus prioridades y etiquetas.
     * 
     * @param StoreTareaRequest $request
     * @return JsonResponse
     */
    public function store(StoreTareaRequest $request): JsonResponse
    {
        try {

            $data = $request->validated();

            $etiquetas = $data['etiquetas'] ?? [];
            unset($data['etiquetas']);

            $tarea = Tarea::create($data);

            if (!empty($etiquetas)) {
                $tarea->etiquetas()->attach($etiquetas);
            }

            $tarea->load(['prioridad', 'etiquetas']);

            return response()->json(['data' => $tarea], 201);
            
        } catch (Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    /**
     * Mostrar una tarea con sus prioridades y etiquetas.
     *
     * @param Tarea $tarea
     * @return JsonResponse
     */
    public function show(Tarea $tarea): JsonResponse
    {
        try {
            $tarea->load(['prioridad', 'etiquetas']);
            return response()->json(['data' => $tarea], 200);
        } catch (Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    /**
     * Actualizar una tarea existente con sus prioridades y etiquetas.
     *
     * @param UpdateTareaRequest $request
     * @param Tarea $tarea
     * @return JsonResponse
     */
    public function update(UpdateTareaRequest $request, Tarea $tarea): JsonResponse
    {
        try {
            $data = $request->validated();

            $etiquetas = $data['etiquetas'] ?? null;
            unset($data['etiquetas']);

            $tarea->update($data);

            if (is_array($etiquetas)) {
                $tarea->etiquetas()->sync($etiquetas);
            }

            $tarea->load(['prioridad', 'etiquetas']);

            return response()->json(['data' => $tarea], 200);
        } catch (Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    /**
     * Elimina una tarea existente con sus prioridades y etiquetas.
     *
     * @param Tarea $tarea
     * @return JsonResponse
     */
    public function destroy(Tarea $tarea): JsonResponse
    {
        try {
            $tarea->delete();
            return response()->json(null, 204);
        } catch (Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
