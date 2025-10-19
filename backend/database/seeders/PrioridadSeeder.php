<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prioridad;

class PrioridadSeeder extends Seeder
{
    public function run(): void
    {
        $values = ['BAJA', 'MEDIA', 'ALTA'];

        foreach ($values as $val) {
            Prioridad::firstOrCreate(['prioridad' => $val]);
        }
    }
}