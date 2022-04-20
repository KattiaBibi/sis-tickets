<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //

    protected $table ='empresas';
    protected $primaryKey = 'id';

    protected $fillable = [
    'ruc',
    'nombre',
    'direccion',
    'telefono',
    'estado'

    ];

}
