<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Etiqueta;

class EtiquetaSeeder extends Seeder
{
    public function run(): void
    {
        $values = ['DEV', 'QA', 'RRHH'];

        foreach ($values as $val) {
            Etiqueta::firstOrCreate(['etiqueta' => $val]);
        }
    }
}