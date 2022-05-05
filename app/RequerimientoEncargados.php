<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequerimientoEncargados extends Model
{
    //

    protected $table ='requerimiento_encargados';
    protected $primaryKey = 'id';

    protected $fillable = [
        'requerimiento_id',
        'usuarioencarg_id'

    ];

}
