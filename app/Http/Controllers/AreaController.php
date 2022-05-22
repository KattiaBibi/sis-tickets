<?php

namespace App\Http\Controllers;

use App\Area;
use App\EmpresaArea;
use Illuminate\Http\Request;
use App\Http\Requests\AreaRequest;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\View\Components\Form\Input;

class AreaController extends Controller
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


  public function area(Request $request)
  {
    $areas = DB::table('empresa_areas')
      ->select('areas.id as id', 'areas.nombre as nombre', 'areas.estado as estado', 'empresas.id as empresa_id', 'empresas.nombre as nombre_empresa', 'empresa_areas.id AS empresa_areas_id')
      ->join('areas', 'areas.id', '=', 'empresa_areas.area_id')
      ->join('empresas', 'empresas.id', '=', 'empresa_areas.empresa_id');
    if ($request->input('id_empresa')) {
      $areas->where('empresa_areas.empresa_id', '=', $request->input('id_empresa'));
    }

    return datatables()->of($areas)->toJson();
  }

  public function index()
  {
    //

    $areas = Area::all();

    return view('area.index', compact('areas'));
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
  public function store(AreaRequest $request)
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
   * @param  \App\Area  $area
   * @return \Illuminate\Http\Response
   */
  public function show(Area $area)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Area  $area
   * @return \Illuminate\Http\Response
   */
  public function edit(Area $area)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Area  $area
   * @return \Illuminate\Http\Response
   */

  public function update(AreaRequest $request, $id)
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
   * @param  \App\Area  $area
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, $id)
  {
    //

    $area = Area::findOrfail($id);

    if ($area->estado == 1) {
      $area->estado = 0;
    } else {
      $area->estado = 1;
    }

    $area->update();

    return $area ? 1 : 0;
  }
}
