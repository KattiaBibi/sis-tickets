<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //

    protected $table ='empresas';
    protected $primaryKey = 'id';

    protected $fillable = [
    'nombre',
    'direccion',
    'telefono',
    'estado_id'
    
    ];

}
