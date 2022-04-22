<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCita extends Model
{
    protected $table ='detalle_citas';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'cita_id',
        'usuario_colab_id',
    ];
}
