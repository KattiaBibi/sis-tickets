<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColaboradorEmpresaArea extends Model
{
  protected $table = 'colaborador_empresa_area';
  protected $primaryKey = 'id';

  protected $fillable = [
    'correo_corporativo',
    'colaborador_id',
    'empresa_area_id',
  ];
}
