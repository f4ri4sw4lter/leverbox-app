<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
    use HasFactory;

    protected $table = 'prioridades';

    protected $fillable = [
        'prioridad',
    ];

    // Relación 1 a muchos: una prioridad puede tener muchas tareas
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'prioridad_id');
    }
}