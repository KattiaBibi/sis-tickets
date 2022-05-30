<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialFechaHora extends Model
{
    //

    protected $table ='historial_requerimientos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'fechahoraprogramada',
        'motivo',
        'detalle_requerimiento_id'
    ];
}
