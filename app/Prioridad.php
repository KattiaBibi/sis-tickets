<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
    //

    protected $table ='prioridades';
    protected $primaryKey = 'id';

    protected $fillable = [

        'nombre',
        'detalle',
        'estado_id',

    ];

}
