<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prioridades', function (Blueprint $table) {
            $table->id();
            $table->enum('prioridad', ['BAJA', 'MEDIA', 'ALTA'])->unique();
            $table->timestamps();
            $table->string('color');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prioridades');
    }
};