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
        $requerimiento = DB::table('requerimientos')
            ->select(
                DB::raw("requerimientos.titulo AS titulo"),
                DB::raw("requerimientos.created_at AS fecha_creacion"),
                DB::raw("requerimientos.prioridad AS prioridad"),
                DB::raw("empresas.id AS id_empresa"),
                DB::raw("empresas.nombre AS nombre_empresa"),
                DB::raw("servicios.nombre AS nombre_servicio"),
                "colaboradores.id AS id_solicitante",
                DB::raw("CONCAT(colaboradores.nombres, ' ', colaboradores.apellidos) AS nom_ape_solicitante"),
                "solicitante.email AS email_solicitante",
                "colaboradores.nombres AS nombre_solicitante",
                "colaboradores.apellidos AS apellido_solicitante",
            )
            ->join('empresa_servicios', 'empresa_servicios.id', '=', 'requerimientos.empresa_servicio_id')
            ->join('empresas', 'empresas.id', '=', 'empresa_servicios.empresa_id')
            ->join('servicios', 'servicios.id', '=', 'empresa_servicios.servicio_id')
            ->join('users AS solicitante', 'solicitante.id', '=', 'requerimientos.usuarioregist_id')
            ->join('colaboradores', 'colaboradores.id', '=', 'solicitante.colaborador_id')
            ->where("requerimientos.id", "=", $id)
            ->get()->first();

        $requerimiento->encargados = DB::table('requerimiento_encargados')
            ->select(
                "colaboradores.id AS id",
                DB::raw("CONCAT(colaboradores.nombres, ' ', colaboradores.apellidos) AS nom_ape_encargado"),
                "colaboradores.nombres AS nombre",
                "colaboradores.apellidos AS apellido",
                DB::raw("COALESCE((SELECT colaborador_empresa_area.correo_corporativo
                FROM colaborador_empresa_area
                INNER JOIN empresa_areas ON empresa_areas.id = colaborador_empresa_area.empresa_area_id
                WHERE colaborador_empresa_area.colaborador_id = colaboradores.id AND empresa_areas.empresa_id = $requerimiento->id_empresa), encargado.email) AS email")
            )
            ->join('users AS encargado', 'encargado.id', '=', 'requerimiento_encargados.usuarioencarg_id')
            ->join('colaboradores', 'colaboradores.id', '=', 'encargado.colaborador_id')
            ->where("requerimiento_encargados.requerimiento_id", "=", $id)
            ->get()->all();

        $requerimiento->asignados = DB::table('detalle_requerimientos')
            ->select(
                "colaboradores.id AS id",
                DB::raw("CONCAT(colaboradores.nombres, ' ', colaboradores.apellidos) AS nom_ape_asignado"),
                "colaboradores.nombres AS nombre",
                "colaboradores.apellidos AS apellido",
                DB::raw("COALESCE((SELECT colaborador_empresa_area.correo_corporativo
                FROM colaborador_empresa_area
                INNER JOIN empresa_areas ON empresa_areas.id = colaborador_empresa_area.empresa_area_id
                WHERE colaborador_empresa_area.colaborador_id = colaboradores.id AND empresa_areas.empresa_id = $requerimiento->id_empresa), asignado.email) AS email")
            )
            ->join('users AS asignado', 'asignado.id', '=', 'detalle_requerimientos.usuario_colab_id')
            ->join('colaboradores', 'colaboradores.id', '=', 'asignado.colaborador_id')
            ->where("detalle_requerimientos.requerimiento_id", "=", $id)
            ->get()->all();

        return $requerimiento;
    }
}
