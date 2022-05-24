<?php

namespace App\Http\Controllers;

use App\EmpresaArea;
use App\Empresa;
use App\Area;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaAreaRequest;
use Illuminate\Support\Facades\DB;

class EmpresaAreaController extends Controller
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

  public function empresa_area()
  {
    $empresa_areas = DB::table('empresa_areas')
      ->join('empresas', 'empresa_areas.empresa_id', '=', 'empresas.id')
      ->join('areas', 'empresa_areas.area_id', '=', 'areas.id')
      ->select(
        'empresa_areas.id as empresa_area_id',
        'empresas.id as empresa_id',
        'areas.id as area_id',
        'empresas.nombre as nombre_empresa',
        'areas.nombre as nombre_area'
      );

    return datatables()->of($empresa_areas)->toJson();
  }

  public function index()
  {
    $empresas = DB::table('empresas')->where('estado', '=', '1')->get();
    $areas = DB::table('areas')->where('estado', '=', '1')->get();

    return view('empresa_area.index', compact('empresas', 'areas'));
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
  public function store(EmpresaAreaRequest $request)
  {
    $area = Area::create($request->all());
    $empresaArea = EmpresaArea::create(
      [
        'empresa_id' => $request->input('empresa_id'),
        'area_id' => $area->id
      ]
    );

    return $area ? 1 : 0;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\EmpresaArea  $empresaArea
   * @return \Illuminate\Http\Response
   */
  public function show(EmpresaArea $empresaArea)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\EmpresaArea  $empresaArea
   * @return \Illuminate\Http\Response
   */
  public function edit(EmpresaArea $empresaArea)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\EmpresaArea  $empresaArea
   * @return \Illuminate\Http\Response
   */
  public function update(EmpresaAreaRequest $request, $id)
  {
    $area = Area::findOrfail($id);
    $area->update($request->all());

    $empresaArea = EmpresaArea::findOrfail($request->input('empresa_area_id'));
    $empresaArea->empresa_id = $request->input('empresa_id');
    $empresaArea->area_id = $id;
    $empresaArea->update(array ($empresaArea));

    return $area ? 1 : 0;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\EmpresaArea  $empresaArea
   * @return \Illuminate\Http\Response
   */
  public function destroy(EmpresaArea $empresaArea)
  {
    //
  }

  public function search(Request $request)
  {
    $search = $request->get('search');
    $page = $request->get('page');
    $filters = $request->get('filters') ?? [];

    $empresaAreaModel = new EmpresaArea();
    $data = $empresaAreaModel->search($search, $page, $filters);
    return response()->json($data);
  }
}
