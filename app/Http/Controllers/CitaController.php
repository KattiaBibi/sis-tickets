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
    $start = request('start');
    $end = request('end');

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
      ->where('citas.fecha', '>=', $start)
      ->where('citas.fecha', '<=', $end)
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
      'tipocita' => [
        'required',
        Rule::in(['presencial', 'virtual'])
      ],
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
      return response()->json(['messages' => $validator->errors()]);
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
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $cita = Cita::find($id);
    if (is_null($cita)) {
      return response()->json(['messages' => 'resource not found.'], 404);
    }

    $input = $request->all();

    $validator = Validator::make($input, [
      'titulo' => 'required|max:50',
      'tipocita' => [
        'required',
        Rule::in(['presencial', 'virtual'])
      ],
      'descripcion' => 'nullable|max:250',
      'fecha' => 'required|date_format:Y-m-d',
      'hora_inicio' => 'required|date_format:H:i',
      'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
      'link_reu' => 'nullable|max:150',
      'empresa_id' => 'nullable|exists:empresas,id',
      'lugarreu' => 'nullable|max:150',
      'asistentes' => 'required|exists:colaboradores,id',
      'estado' => [
        'required',
        Rule::in(['pendiente', 'concluida', 'cancelada'])
      ]
    ]);

    if ($validator->fails()) {
      return response()->json(['messages' => $validator->errors()]);
    }

    $cita->titulo = $request->get('titulo');
    $cita->tipocita = $request->get('tipocita');
    $cita->descripcion = $request->get('descripcion');
    $cita->fecha = $request->get('fecha');
    $cita->hora_inicio = $request->get('hora_inicio');
    $cita->hora_fin = $request->get('hora_fin');
    $cita->link_reu = $request->get('link_reu');
    $cita->empresa_id = $request->get('empresa_id');
    $cita->lugarreu = $request->get('lugarreu');
    $cita->estado = $request->get('estado');

    DB::transaction(function () use ($id, $cita, $input) {
      $cita->save();
      DetalleCita::where('cita_id', '=', $id)->delete();
      $detallesCita = [];
      foreach ($input['asistentes'] as $asistente) {
        array_push(
          $detallesCita,
          [
            'cita_id' => $id,
            'usuario_colab_id' => $asistente
          ]
        );
      }
      DetalleCita::insert($detallesCita);
    });

    return response()->json([
      "messages" => "Resource updated successfully.",
      "data" => $input
    ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $cita = Cita::find($id);
    if (is_null($cita)) {
      return response()->json(['messages' => 'Resource not found.'], 404);
    }

    DB::transaction(function () use ($id, $cita) {
      DetalleCita::where('cita_id', '=', $id)->delete();
      $cita->delete();
    });

    return response()->json([
      "messages" => "Resource deleted successfully.",
      "data" => $cita
    ]);
  }
}
