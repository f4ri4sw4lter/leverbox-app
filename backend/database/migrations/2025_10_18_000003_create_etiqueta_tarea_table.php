<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pivot table: etiquetas <-> tareas
        Schema::create('etiqueta_tarea', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tarea_id')->constrained('tareas')->onDelete('cascade');
            $table->foreignId('etiqueta_id')->constrained('etiquetas')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['tarea_id', 'etiqueta_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etiqueta_tarea');
    }
};