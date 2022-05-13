<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empresa extends Model
{
  //

  protected $table = 'empresas';
  protected $primaryKey = 'id';

  protected $fillable = [
    'ruc',
    'nombre',
    'direccion',
    'telefono',
    'color',
    'estado'
  ];

  private function getFilters($query, $filters)
  {
    if (isset($filters['search']) && trim($filters['search']) !== '') {
      $query->where("nombre", 'like', '%' . trim($filters['search']) . '%');
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

    $query = DB::table('empresas')->select(DB::raw('COUNT(empresas.id) AS count_filtered'));

    $countFiltered = $this->getFilters($query, $filters)->first()->count_filtered;

    $query = DB::table('empresas')->select("id", "nombre as text");

    $resultSet['results'] = $this->getFilters($query, $filters)->limit($limit)->offset($offset)->get();

    $resultSet['pagination'] = ['more' => ($page * $limit) < $countFiltered];

    return $resultSet;
  }
}
