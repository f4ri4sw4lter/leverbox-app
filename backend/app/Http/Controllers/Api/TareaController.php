<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use App\Models\Etiqueta;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;
use Illuminate\Http\JsonResponse;

class TareaController extends Controller
{
    /**
     * Listar todas las tareas.
     */
    public function index(): JsonResponse
    {
        // Cargar prioridad y etiquetas para cada tarea
        $tareas = Tarea::with(['prioridad', 'etiquetas'])->get();

        return response()->json(['data' => $tareas], 200);
    }

    /**
     * Crear una tarea.
     */
    public function store(StoreTareaRequest $request): JsonResponse
    {
        $data = $request->validated();

        $etiquetas = $data['etiquetas'] ?? [];
        unset($data['etiquetas']);

        $tarea = Tarea::create($data);

        if (!empty($etiquetas)) {
            $tarea->etiquetas()->attach($etiquetas);
        }

        $tarea->load(['prioridad', 'etiquetas']);

        return response()->json(['data' => $tarea], 201);
    }

    /**
     * Ver una tarea específica.
     */
    public function show(Tarea $tarea): JsonResponse
    {
        $tarea->load(['prioridad', 'etiquetas']);

        return response()->json(['data' => $tarea], 200);
    }

    /**
     * Editar/actualizar una tarea.
     */
    public function update(UpdateTareaRequest $request, Tarea $tarea): JsonResponse
    {
        $data = $request->validated();

        $etiquetas = $data['etiquetas'] ?? null;
        unset($data['etiquetas']);

        $tarea->update($data);

        if (is_array($etiquetas)) {
            // sincroniza etiquetas (remueve las antiguas que no estén en la lista)
            $tarea->etiquetas()->sync($etiquetas);
        }

        $tarea->load(['prioridad', 'etiquetas']);

        return response()->json(['data' => $tarea], 200);
    }

    /**
     * Eliminar una tarea.
     */
    public function destroy(Tarea $tarea): JsonResponse
    {
        $tarea->delete();

        return response()->json(null, 204);
    }
}