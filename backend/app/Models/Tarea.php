<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tareas';

    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'fecha_vencimiento',
        'prioridad_id',
    ];

    protected $casts = [
        'fecha_vencimiento' => 'date',
    ];

    // Relación: cada tarea pertenece a una prioridad
    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'prioridad_id');
    }

    // Relación muchos a muchos con Etiqueta
    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class, 'etiqueta_tarea', 'tarea_id', 'etiqueta_id')
                    ->withTimestamps();
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }
}