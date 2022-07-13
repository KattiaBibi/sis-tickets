<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Requerimiento extends Model
{
    //
    protected $table = 'requerimientos';
    protected $primaryKey = 'id';

    protected $fillable = [

        'titulo',
        'descripcion',
        'avance',
        'prioridad',
        'estado',
        'imagen',
        'archivo',
        'empresa_servicio_id',
        'usuarioregist_id'

    ];

    static function getById(string $id)
    {
        return DB::table('requerimientos')
            ->select(
                DB::raw("requerimientos.titulo AS titulo"),
                DB::raw("requerimientos.created_at AS fecha_creacion"),
                DB::raw("requerimientos.prioridad AS prioridad"),
                DB::raw("empresas.nombre AS nombre_empresa"),
                DB::raw("servicios.nombre AS nombre_servicio"),
                DB::raw("CONCAT(colaboradores.nombres, ' ', colaboradores.nombres) AS nom_ape_solicitante")
            )
            ->where("requerimientos", "=", $id)
            ->get()
            ->first();
    }
}
