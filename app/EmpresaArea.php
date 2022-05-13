<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmpresaArea extends Model
{
  //

  protected $table = 'empresa_areas';
  protected $primaryKey = 'id';

  protected $fillable = [
    'empresa_id',
    'area_id'
  ];

  private function getFilters($query, $filters)
  {
    if (isset($filters['search']) && trim($filters['search']) !== '') {
      $query->where(DB::raw("CONCAT(empresas.nombre, ' ', areas.nombre)"), 'like', '%' . trim($filters['search']) . '%');
    }

    return $query;
  }

  public function search($search, $page, $filters)
  {
    $resultSet = [];
    $limit = 10;
    $page = (!empty($page)) ? $page : 1;
    $offset = ($page - 1) * $limit;

    $filters['search'] = $search;

    $query = DB::table('empresa_areas')
      ->select(
        DB::raw('COUNT(empresa_areas.id) AS count_filtered')
      )
      ->join('areas', 'areas.id', '=', 'empresa_areas.area_id')
      ->join('empresas', 'empresas.id', '=', 'empresa_areas.empresa_id');

    $countFiltered = $this->getFilters($query, $filters)->first()->count_filtered;

    $query = DB::table('empresa_areas')
      ->select(
        "empresa_areas.id AS id",
        DB::raw("CONCAT(empresas.nombre, ' - ', areas.nombre) AS text")
      )
      ->join('areas', 'areas.id', '=', 'empresa_areas.area_id')
      ->join('empresas', 'empresas.id', '=', 'empresa_areas.empresa_id');

    $resultSet['results'] = $this->getFilters($query, $filters)->limit($limit)->offset($offset)->get();

    $resultSet['pagination'] = ['more' => ($page * $limit) < $countFiltered];

    return $resultSet;
  }
}
