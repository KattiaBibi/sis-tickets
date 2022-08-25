<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequerimientoRespuesta extends Model
{
    protected $table = 'requerimiento_respuestas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'ruta_recurso',
        'descripcion',
        'user_id',
        'requerimiento_id'
    ];
}
