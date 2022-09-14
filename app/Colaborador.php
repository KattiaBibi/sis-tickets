<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Colaborador extends Model
{
  protected $table = 'colaboradores';
  protected $primaryKey = 'id';

  protected $fillable = [
    'nrodocumento',
    'nombres',
    'apellidos',
    'fechanacimiento',
    'direccion',
    'telefono',
    'estado',
  ];

  private function getFilters($query, $filters)

  {
    $query->where('colaboradores.estado', '=', 1);

    if (isset($filters['nom_ape']) && $filters['nom_ape'] !== '') {
      $query->where(function ($query) use ($filters) {
        $query->where('nombres', 'like', '%' . $filters['nom_ape'] . '%');
        $query->orWhere('apellidos', 'like', '%' . $filters['nom_ape'] . '%');
      });
    }

    if (isset($filters['role_id']) && $filters['role_id'] !== '') {
      $query->where('model_has_roles.role_id', '=', $filters['role_id']);
    }

    return $query;
  }


  public function search($search, $page, $filters)
  {
    $resultSet = [];
    $limit = 10;
    $page = (!empty($page)) ? $page : 1;
    $offset = ($page - 1) * $limit;

    $filters['nom_ape'] = $search;

    $query = DB::table('colaboradores')
      ->select(DB::raw('COUNT(colaboradores.id) AS count_filtered'))
      ->join('users', 'users.colaborador_id', '=', 'colaboradores.id', 'inner')
      ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id', 'inner');


    $countFiltered = $this->getFilters($query, $filters)->first()->count_filtered;

    $query = DB::table('colaboradores')
      ->select(
        "colaboradores.id AS id",
        DB::raw("CONCAT(colaboradores.nombres, ' ', colaboradores.apellidos) AS text")
      )
      ->join('users', 'users.colaborador_id', '=', 'colaboradores.id', 'inner')
      ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id', 'inner');

    $resultSet['results'] = $this->getFilters($query, $filters)->limit($limit)->offset($offset)->get();

    $resultSet['pagination'] = ['more' => ($page * $limit) < $countFiltered];

    return $resultSet;
  }

  static function getContactInfoByUserIds(array $userIds)
  {
    return DB::table('colaboradores')
      ->select(
        DB::raw("CONCAT(colaboradores.nombres, ' ', colaboradores.apellidos) AS nom_ape"),
        "colaboradores.telefono AS telefono",
        "colaboradores.prefijo AS prefijo"
      )
      ->join('users', 'users.colaborador_id', '=', 'colaboradores.id')
      ->whereIn('users.id', $userIds)
      ->get()->all();
  }
}
