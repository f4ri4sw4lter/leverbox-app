<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PrioridadSeeder::class,
            EtiquetaSeeder::class,
            TareaSeeder::class,
        ]);
    }
}