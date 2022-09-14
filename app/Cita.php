<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cita extends Model
{
  protected $table = 'citas';
  protected $primaryKey = 'id';

  protected $fillable = [
    'titulo',
    'descripcion',
    'fecha',
    'hora_inicio',
    'hora_fin',
    'link_reu',
    'otro_cliente',
    'lugarreu',
    'tipocita',
    'estado',
    'usuario_id',
    'empresa_id',
  ];

  public function index($limit = null, $offset = null, array $filters = [])
  {
    $query = DB::table('citas')
      ->select(
        "citas.id as id",
        "citas.titulo as titulo",
        "citas.descripcion as descripcion",
        "citas.fecha as fecha",
        DB::raw("TIMESTAMP(citas.fecha, citas.hora_inicio) as fecha_inicio"),
        DB::raw("TIMESTAMP(citas.fecha, citas.hora_fin) as fecha_fin"),
        "citas.hora_inicio as hora_inicio",
        "citas.hora_fin as hora_fin",
        "citas.tipocita as tipo",
        "citas.link_reu as link",
        "citas.empresa_id as empresa_id",
        DB::raw("CONCAT(empresas.nombre, ' (', empresas.direccion, ')') as descripcion_empresa"),
        "empresas.color as color_empresa",
        "citas.lugarreu as otra_oficina",
        "usuario_id as id_registrado_por",
        DB::raw("CONCAT(colaboradores.nombres, ' ', colaboradores.apellidos) AS registrado_por"),
        "citas.estado AS estado",
      )
      ->join('empresas', 'empresas.id', '=', 'citas.empresa_id', 'left')
      ->join('users', 'users.id', '=', 'citas.usuario_id')
      ->join('colaboradores', 'colaboradores.id', '=', 'users.colaborador_id');

    $query = $this->getFilters($query, $filters);

    if ($limit && $offset) $query->limit($limit)->offset($offset);

    $citas = $query->get()->all();

    foreach ($citas as &$cita) {
      $cita->asistentes = DB::table('detalle_citas')
        ->select(
          "detalle_citas.id as detalle_cita_id",
          "detalle_citas.usuario_colab_id as asistente_id",
          "colaboradores.nombres AS nombres",
          "colaboradores.apellidos AS apellidos",
          "detalle_citas.confirmation AS confirmation",
          "detalle_citas.confirmation_at AS confirmation_at",
          "users.email AS email",
          "colaboradores.telefono AS telefono",
          "colaboradores.prefijo AS prefijo"
        )
        ->join('colaboradores', 'colaboradores.id', '=', 'detalle_citas.usuario_colab_id')
        ->join('users', 'users.colaborador_id', '=', 'colaboradores.id')
        ->where('cita_id', $cita->id)
        ->get()->all();
    }

    return $citas;
  }

  private function getFilters($query, $filters)
  {
    if (isset($filters['id_cita']) && !empty($filters['id_cita'])) {
      $query->where('citas.id', '=',  $filters['id_cita']);
    }

    if (isset($filters['fecha_inicio']) && !empty($filters['fecha_inicio'])) {
      $query->where('citas.fecha', '>=',  $filters['fecha_inicio']);
    }

    if (isset($filters['fecha_fin']) && !empty($filters['fecha_fin'])) {
      $query->where('citas.fecha', '<=',  $filters['fecha_fin']);
    }

    if (isset($filters['estado']) && $filters['estado'] !== 'todos') {
      $query->where('citas.estado', '=',  $filters['estado']);
    }

    return $query;
  }
}
