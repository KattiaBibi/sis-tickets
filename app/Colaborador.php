<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    //
        protected $table ='colaboradores';
        protected $primaryKey = 'id';

    protected $fillable = [

        'nrodocumento',
        'nombres',
        'apellidos',
        'fechanacimiento',
        'direccion',
        'telefono',
        'empresa_area_id',
        'estado_id'
    ];
}
