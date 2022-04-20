<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColaboradorEmpresas extends Model
{
    //

    protected $table ='colaborador_empresas';
    protected $primaryKey = 'id';

protected $fillable = [

    'colaborador_id',
    'empresa_id',

];
}
