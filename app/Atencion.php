<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    //

    protected $table ='atenciones';
    protected $primaryKey = 'id';

    protected $fillable = [

      'descripcion',
      'usuarioadmin_id',
      'ticket_id',
      'servicio_id',
      'prioridad_id',
      'estado_id'
    ];

}
