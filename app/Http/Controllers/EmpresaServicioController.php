<?php

namespace App\Http\Controllers;

use App\EmpresaServicio;
use App\Empresa;
use App\Servicio;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaServicioRequest;
use Illuminate\Support\Facades\DB;

class EmpresaServicioController extends Controller
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

  public function empresa_servicio(Request $request)
  {
    $query = DB::table('empresa_servicios')
      ->select(
        "empresa_servicios.id as id_empresa_servicio",
        "empresa_servicios.empresa_id as id_empresa",
        "empresas.nombre as nombre_empresa",
        "empresa_servicios.servicio_id as id_servicio",
        "servicios.nombre as nombre_servicio",
      )
      ->join('empresas', 'empresas.id', '=', 'empresa_servicios.empresa_id')
      ->join('servicios', 'servicios.id', '=', 'empresa_servicios.servicio_id');

    if ($request->input('id_empresa')) {
      $query->where('empresa_servicios.empresa_id', '=', $request->input('id_empresa'));
    }

    return datatables()->of($query)->toJson();
  }


  public function index()
  {
    //

    $empresas = DB::table('empresas')->where('estado', '=', '1')->get();
    $servicios = DB::table('servicios')->where('estado', '=', '1')->get();

    return view('empresa_servicio.index', compact('empresas', 'servicios'));
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
  public function store(EmpresaServicioRequest $request)
  {
    $servicio = Servicio::create($request->all());
    $empresaServicio = EmpresaServicio::create(
      [
        'empresa_id' => $request->input('id_empresa'),
        'servicio_id' => $servicio->id
      ]
    );

    return $servicio ? 1 : 0;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\EmpresaServicio  $empresaServicio
   * @return \Illuminate\Http\Response
   */
  public function show(EmpresaServicio $empresaServicio)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\EmpresaServicio  $empresaServicio
   * @return \Illuminate\Http\Response
   */
  public function edit(EmpresaServicio $empresaServicio)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(EmpresaServicioRequest $request, $id)
  {
    $servicio = Servicio::findOrfail($id);
    $servicio->update($request->all());

    $empresaServicio = EmpresaServicio::findOrfail($request->input('id_empresa_servicio'));
    $empresaServicio->empresa_id = $request->input('id_empresa');
    $empresaServicio->servicio_id = $id;
    $empresaServicio->update(array($empresaServicio));

    return $servicio ? 1 : 0;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\EmpresaServicio  $empresaServicio
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, $id)
  {
    $servicio = Servicio::findOrfail($id);

    if ($servicio) {
      DB::table('empresa_servicios')->where('servicio_id', $id)->delete();
      DB::table('servicios')->where('id', $id)->delete();
    }

    return $servicio ? 1 : 0;
  }
}
