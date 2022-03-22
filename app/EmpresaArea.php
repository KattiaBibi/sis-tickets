<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaArea extends Model
{
    //

    protected $table ='empresa_areas';
    protected $primaryKey = 'id';

    protected $fillable = [
       'empresa_id',
       'area_id'
    ];
}
