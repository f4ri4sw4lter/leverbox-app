<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTareaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string'],
            'estado' => ['required', Rule::in(['pendiente', 'en_progreso', 'completada'])],
            'fecha_vencimiento' => ['nullable', 'date'],
            'prioridad_id' => ['required', 'integer', 'exists:prioridades,id'],
            'etiquetas' => ['nullable', 'array'],
            'etiquetas.*' => ['integer', 'exists:etiquetas,id'],
        ];
    }
}