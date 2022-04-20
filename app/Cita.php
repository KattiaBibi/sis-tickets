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
        'link_reu',
        'otro_cliente',
        'lugarreu',
        'tipo_cita',
        'estado',
        'usuario_id',
        'empresa_id',
    

    ];

}
