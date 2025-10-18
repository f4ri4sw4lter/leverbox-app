<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    use HasFactory;

    protected $table = 'etiquetas';

    protected $fillable = [
        'etiqueta',
    ];

    // Relación muchos a muchos con Tarea
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'etiqueta_tarea', 'etiqueta_id', 'tarea_id')
                    ->withTimestamps();
    }
}