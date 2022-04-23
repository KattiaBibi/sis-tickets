<?php

namespace App\Http\Controllers;

use App\Cita;
use App\Empresa;
use App\Colaborador;
use App\DetalleCita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CitaController extends Controller
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

  public function index()
  {
    //

    $empresas = Empresa::all();
    $colaboradores = Colaborador::all();

    return view('cita.calendario', compact('empresas', 'colaboradores'));
  }

  public function getForFullCalendar()
  {
    $citas = DB::table('citas')
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
        "citas.lugarreu AS otra_oficina",
        "citas.estado AS estado",
      )
      ->join('empresas', 'empresas.id', '=', 'citas.empresa_id', 'left')
      ->get()->all();

    foreach ($citas as &$cita) {
      $cita->asistentes = DB::table('detalle_citas')
        ->select(
          "detalle_citas.usuario_colab_id as id",
          "colaboradores.nombres AS nombres",
          "colaboradores.apellidos AS apellidos"
        )
        ->join('colaboradores', 'colaboradores.id', '=', 'detalle_citas.usuario_colab_id')
        ->where('cita_id', $cita->id)
        ->get()->all();
    }

    // dd($citas);

    return response()->json([
      "messages" => "Resource retrieved successfully.",
      "data" => $citas
    ]);
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
  public function store(Request $request)
  {
    $input = $request->all();

    $validator = Validator::make($input, [
      'titulo' => 'required|max:50',
      'tipocita' => Rule::in(['presencial', 'virtual']),
      'descripcion' => 'nullable|max:250',
      'fecha' => 'required|date_format:Y-m-d',
      'hora_inicio' => 'required|date_format:H:i',
      'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
      'link_reu' => 'nullable|max:150',
      'empresa_id' => 'nullable|exists:empresas,id',
      'lugarreu' => 'nullable|max:150',
      'asistentes' => 'required|exists:colaboradores,id'
    ]);

    if ($validator->fails()) {
      return response()->json(['messages' => $validator->errors()], 400);
    }

    $input['usuario_id'] = auth()->user()->id;
    $input['estado'] = 'pendiente';

    DB::transaction(function () use ($input) {
      $resource = Cita::create($input);
      $detallesCita = [];
      foreach ($input['asistentes'] as $asistente) {
        array_push(
          $detallesCita,
          [
            'cita_id' => $resource->id,
            'usuario_colab_id' => $asistente
          ]
        );
      }
      DetalleCita::insert($detallesCita);
    });

    return response()->json([
      "messages" => "Resource created successfully.",
      "data" => $input
    ], 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Cita  $cita
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $resource = DB::table('citas')
      ->select(
        "citas.titulo as titulo",
        "citas.descripcion as descripcion",
        "citas.fecha as fecha_",
        "citas.hora_inicio as hora_inicio",
        "citas.hora_fin as hora_fin",
        "citas.tipocita as tipo",
        "citas.link_reu as link",
        "citas.empresa_id as empresa_id",
        DB::raw("CONCAT(empresas.nombre, ' (', empresas.direccion, ')') as descripcion_empresa"),
        "citas.lugarreu AS otra_oficina",
        "citas.estado AS estado",
      )
      ->join('empresas', 'empresas.id', '=', 'citas.empresa_id', 'left')
      ->where('citas.id', '=', $id)
      ->get()->first();

    $resource->asistente = DB::table('detalle_citas')
      ->select(
        "detalle_citas.usuario_colab_id as id",
        "colaboradores.nombres AS nombres",
        "colaboradores.apellidos AS apellidos"
      )
      ->join('colaboradores', 'colaboradores.id', '=', 'detalle_citas.usuario_colab_id')
      ->where('cita_id', $id)
      ->get()->all();

    return response()->json([
      "messages" => "Resource retrieved successfully.",
      "data" => $resource
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Cita  $cita
   * @return \Illuminate\Http\Response
   */
  public function edit(Cita $cita)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Cita  $cita
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Cita $cita)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Cita  $cita
   * @return \Illuminate\Http\Response
   */
  public function destroy(Cita $cita)
  {
    //
  }
}
