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
        'empresa_servicio_id',
        'usuarioregist_id',
        'usuarioencarg_id'

    ];


}
