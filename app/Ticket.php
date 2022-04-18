<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //


    protected $table ='tickets';
    protected $primaryKey = 'id';

    protected $fillable = [

        'problema',
        'detalle',
        'empresa_servicio_id',
        'usuario_id',

    ];

}
