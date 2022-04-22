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
        'fecha',
        'hora_inicio',
        'hora_fin',
        'link_reu',
        'otro_cliente',
        'lugarreu',
        'tipocita',
        'estado',
        'usuario_id',
        'empresa_id',   
    ];

}
