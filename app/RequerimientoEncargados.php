<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequerimientoEncargados extends Model
{
    //

    protected $table ='requerimiento_encargados';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'requerimiento_id',
        'usuarioencarg_id'

    ];

}
