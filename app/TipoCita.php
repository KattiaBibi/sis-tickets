<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCita extends Model
{
    //

    protected $table ='tipo_citas';
    protected $primaryKey = 'id';

    protected $fillable = [

        'nombre',
        'estado_id',

    ];

}
