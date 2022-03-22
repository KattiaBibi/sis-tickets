<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    //


    protected $fillable = [
        
        'id','nrodocumento','nombres','apellidos','fechanacimiento','direccion','telefono','empresa_area_id','estado_id'
    ];
}
