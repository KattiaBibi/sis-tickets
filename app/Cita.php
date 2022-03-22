<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    //

    protected $table ='citas';
    protected $primaryKey = 'id';

    protected $fillable = [

        'titulo',
        'descripcion',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'link_zoom',
        'usuario_id',
        'tipo_cita_id',
        'empresa_id',
        'estado_id',

    ];

}
