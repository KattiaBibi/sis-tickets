<?php

namespace App\Http\Controllers;

use App\Colaborador;
use App\Empresa;
use App\Http\Requests\ColaboradorRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColaboradorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function colaborador()
  {

    $colaboradores = DB::table('colaboradores as c')
      ->join('empresa_areas as ea', 'c.empresa_area_id', '=', 'ea.id')
      ->join('empresas as e', 'ea.empresa_id', '=', 'e.id')
      ->join('areas as a', 'ea.area_id', '=', 'a.id')
      ->select('c.estado as colaborador_estado', 'c.id', 'c.nrodocumento', 'c.nombres', 'c.apellidos', 'c.fechanacimiento', 'c.direccion', 'c.telefono', 'e.nombre as e.nombre', 'a.nombre as a.nombre', 'ea.id as idea', 'e.nombre as nombre_empresa', 'a.nombre as nombre_area', 'ea.id as empresa_area_id');

    if (request()->input('empresa_area_id')) {
      $colaboradores->where('ea.id', '=', request()->input('empresa_area_id'));
    }

    return datatables()->of($colaboradores)->toJson();
  }

  public function index()
  {

    $empresa_areas = DB::table('empresa_areas as ea')
      ->join('empresas as e', 'ea.empresa_id', '=', 'e.id')
      ->join('areas as a', 'ea.area_id', '=', 'a.id')
      ->select('ea.id as eaid', 'e.id as eid', 'a.id as aid', 'e.nombre as enombre', 'a.nombre as anombre')->get();


    return view('colaborador.index', compact('empresa_areas'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ColaboradorRequest $request)
  {
    $colaborador =  Colaborador::create($request->all());

    return $colaborador ? 1 : 0;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Colaborador  $colaborador
   * @return \Illuminate\Http\Response
   */
  public function show(Colaborador $colaborador)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Colaborador  $colaborador
   * @return \Illuminate\Http\Response
   */
  public function edit(Colaborador $colaborador)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int $id
   * @param  \App\Colaborador  $colaborador
   * @return \Illuminate\Http\Response
   */
  public function update(ColaboradorRequest $request, $id)
  {
    $colaborador = Colaborador::findOrfail($id);
    $colaborador->update($request->all());

    return $colaborador ? 1 : 0;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $colaborador = Colaborador::findOrfail($id);

    if ($colaborador->estado == 1) {
      $colaborador->estado = 0;
    } else {
      $colaborador->estado = 1;
    }

    $colaborador->update();

    return $colaborador ? 1 : 0;
  }

  public function search(Request $request)
  {
    $search = $request->get('search');
    $page = $request->get('page');
    $filters = $request->get('filters');

    $colaboradorModel = new Colaborador();
    $data = $colaboradorModel->search($search, $page, $filters);
    return response()->json($data);
  }
}
