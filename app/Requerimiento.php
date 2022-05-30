<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    //
    protected $table ='requerimientos';
    protected $primaryKey = 'id';

    protected $fillable = [

        'titulo',
        'descripcion',
        'avance',
        'prioridad',
        'estado',
        'imagen',
        'empresa_servicio_id',
        'usuarioregist_id'

    ];


}
