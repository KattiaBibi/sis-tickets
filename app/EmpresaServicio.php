<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaServicio extends Model
{
    //

    protected $table ='empresa_servicios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'empresa_id',
        'servicio_id'
     ];
}
