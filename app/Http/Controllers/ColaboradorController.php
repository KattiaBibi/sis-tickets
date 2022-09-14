<?php

namespace App\Http\Controllers;

use App\Colaborador;
use App\ColaboradorEmpresaArea;
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
    $colaboradores = DB::table('colaboradores')
      ->select(
        'colaboradores.id AS id',
        'colaboradores.estado AS estado',
        'colaboradores.nrodocumento AS nrodocumento',
        'nombres',
        'apellidos',
        'fechanacimiento',
        'direccion',
        'telefono'
      )->get();

    foreach ($colaboradores as $colaborador) {
      $colaborador->empresas = DB::table('colaborador_empresa_area')
        ->select(
          'colaborador_empresa_area.id AS id',
          'colaborador_empresa_area.correo_corporativo AS correo_corporativo',
          DB::raw("CONCAT(empresas.nombre, ' (', areas.nombre, ')') AS nombre_empresa_area"),
          'empresa_areas.id AS id_empresa_area',
        )
        ->join('empresa_areas', 'colaborador_empresa_area.empresa_area_id', '=', 'empresa_areas.id')
        ->join('empresas', 'empresa_areas.empresa_id', '=', 'empresas.id')
        ->join('areas', 'empresa_areas.area_id', '=', 'areas.id')
        ->where('colaborador_empresa_area.colaborador_id', '=', $colaborador->id)->get();
    }

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
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ColaboradorRequest $request)
  {
    $input = $request->all();

    DB::transaction(function () use ($input) {
      $colaborador =  Colaborador::create($input);
      $multiEmpresas = [];
      foreach ($input['empresas'] as $empresa) {
        array_push($multiEmpresas, [
          'correo_corporativo' => $empresa['correo'],
          'colaborador_id' => $colaborador->id,
          'empresa_area_id' => $empresa['id_empresa_area'],
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
      }
      ColaboradorEmpresaArea::insert($multiEmpresas);
    });

    return response()->json([
      "messages" => "Resource created successfully.",
      "data" => $input
    ], 201);
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
    $colaborador = Colaborador::find($id);
    
    if (is_null($colaborador)) {
      return response()->json(['errors' => 'Resource not found.'], 404);
    }

    $input = $request->all();

    $colaborador->nrodocumento = $input['nrodocumento'];
    $colaborador->nombres = $input['nombres'];
    $colaborador->apellidos = $input['apellidos'];
    $colaborador->fechanacimiento = $input['fechanacimiento'];
    $colaborador->direccion = $input['direccion'];
    $colaborador->telefono = $input['telefono'];

    DB::transaction(function () use ($id, $colaborador, $input) {
      $colaborador->save();
      ColaboradorEmpresaArea::where('colaborador_id', '=', $id)->delete();

      $multiEmpresas = [];
      foreach ($input['empresas'] as $empresa) {
        array_push($multiEmpresas, [
          'correo_corporativo' => $empresa['correo'],
          'colaborador_id' => $colaborador->id,
          'empresa_area_id' => $empresa['id_empresa_area'],
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);
      }
      ColaboradorEmpresaArea::insert($multiEmpresas);
    });

    return response()->json([
      "messages" => "Resource updated successfully.",
      "data" => $input
    ], 200);
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
