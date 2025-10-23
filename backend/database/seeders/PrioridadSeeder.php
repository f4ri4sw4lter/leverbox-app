<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prioridad;

class PrioridadSeeder extends Seeder
{
    public function run(): void
    {
        $prioridades = [
            [
                'prioridad' => 'BAJA',
                'color' => '#28BA18'
            ],
            [
                'prioridad' => 'MEDIA',
                'color' => '#EDE728'
            ],
            [
                'prioridad' => 'ALTA',
                'color' => '#E02810'
            ],
        ];

        foreach ($prioridades as $prioridad) {
            Prioridad::firstOrCreate(['prioridad' => $prioridad['prioridad'], 'color' => $prioridad['color']]);
        }
    }
}