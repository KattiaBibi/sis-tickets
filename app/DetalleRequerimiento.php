<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleRequerimiento extends Model
{
    //


    protected $table ='detalle_requerimientos';
    protected $primaryKey = 'id';

    protected $fillable = [

      'usuario_colab_id',
      'requerimiento_id',

    ];

}
