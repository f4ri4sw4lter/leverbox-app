<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tarea;
use App\Models\Prioridad;
use App\Models\Etiqueta;
use Illuminate\Support\Str;

class TareaSeeder extends Seeder
{
    public function run(): void
    {
        // Crea unas tareas de ejemplo y las vincula con prioridades y etiquetas
        $prioridadAlta = Prioridad::where('prioridad', 'ALTA')->first();
        $prioridadMedia = Prioridad::where('prioridad', 'MEDIA')->first();
        $dev = Etiqueta::where('etiqueta', 'DEV')->first();
        $qa = Etiqueta::where('etiqueta', 'QA')->first();

        $t1 = Tarea::create([
            'titulo' => 'Implementar endpoint de login',
            'descripcion' => 'Crear el endpoint de autenticación y tests asociados.',
            'estado' => 'en_progreso',
            'fecha_vencimiento' => now()->addDays(3)->toDateString(),
            'prioridad_id' => $prioridadAlta->id,
        ]);
        $t1->etiquetas()->attach([$dev->id, $qa->id]);

        $t2 = Tarea::create([
            'titulo' => 'Revisión RRHH de contrataciones',
            'descripcion' => 'Coordinar entrevistas y actualizar planilla.',
            'estado' => 'pendiente',
            'fecha_vencimiento' => null,
            'prioridad_id' => $prioridadMedia->id,
        ]);
        // si existe etiqueta RRHH la asignamos
        $rrhh = Etiqueta::where('etiqueta', 'RRHH')->first();
        if ($rrhh) {
            $t2->etiquetas()->attach([$rrhh->id]);
        }
    }
}