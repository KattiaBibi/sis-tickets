<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAtencion extends Model
{
    //


    protected $table ='detalle_atenciones';
    protected $primaryKey = 'id';

    protected $fillable = [

      'usuario_colab_id',
      'atencion_id',

    ];

}
