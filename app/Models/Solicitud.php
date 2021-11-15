<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $fillable = [
        'telefono',
        'estado',
        'tipo',
        'detalles_jefe_carrera',
        'NRC',
        'nombre_asignatura',
        'detalles_estudiante',
        'calificacion_aporb',
        'cant_ayudantias',
        'tipo_facilidad',
        'nombre_profesor',
        'archivos',
        'user_id'
    ];
}
