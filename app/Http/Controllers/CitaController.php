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
    $estado = request('estado');

    $query = DB::table('citas')
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
        "empresas.color as color_empresa",
        "citas.lugarreu AS otra_oficina",
        "citas.estado AS estado",
      )
      ->join('empresas', 'empresas.id', '=', 'citas.empresa_id', 'left')
      ->where('citas.fecha', '>=', $start)
      ->where('citas.fecha', '<=', $end);

    if (isset($estado) && $estado !== 'todos') {
      $query->where('citas.estado', '=', $estado);
    }

    $citas = $query->get()->all();

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
      'hora_inicio' => 'required|date_format:H:i|after_or_equal:08:30|before_or_equal:18:30|before:hora_fin',
      'hora_fin' => 'required|date_format:H:i|after_or_equal:08:30|before_or_equal:18:30|after:hora_inicio',
      'link_reu' => 'nullable|max:150',
      'empresa_id' => [
        'nullable',
        Rule::requiredIf(empty($request->get('lugarreu'))),
        'exists:empresas,id',
      ],
      'lugarreu' => [
        Rule::requiredIf(empty($request->get('empresa_id'))),
        'max:150',
      ],
      'asistentes' => 'required|exists:colaboradores,id'
    ], [
      'titulo.required' => 'El campo Título es obligatorio.',
      'titulo.max' => 'El campo titulo debe contener max. 50 caracteres.',
      'tipocita.required' => 'El campo Tipo Cita es obligatorio.',
      'tipocita.in' => 'El campo Tipo Cita solo puede ser: presencial, virtual',
      'descripcion.max' => 'El campo Descripcion debe contener max. 250 caracteres.',
      'fecha.required' => 'El campo Fecha es obligatorio.',
      'fecha.date_format' => 'El campo Fecha debe tener formato año/mes/dia',
      'hora_inicio.required' => 'El campo Hora Inicio es obligatorio.',
      'hora_inicio.date_format' => 'El campo Hora Inicio debe tener formato hora/minutos',
      'hora_inicio.after_or_equal' => 'El campo Hora Inicio debe ser mayor o igual a las 8:30 am',
      'hora_inicio.before_or_equal' => 'El campo Hora Inicio debe ser menor o igual a las 6:30 pm',
      'hora_inicio.before' => 'El campo Hora Inicio debe ser menor al campo Hora Fin',
      'hora_fin.required' => 'El campo Hora Fin es obligatorio.',
      'hora_fin.date_format' => 'El campo Hora Fin debe tener formato hora/minutos',
      'hora_fin.after_or_equal' => 'El campo Hora Fin debe ser mayor o igual a las 8:30 am',
      'hora_fin.before_or_equal' => 'El campo Hora Fin debe ser menor o igual a las 6:30 pm',
      'hora_fin.after' => 'El campo Hora Fin debe ser mayor al campo Hora Inicio',
      'link_reu.max' => 'El campo Link debe contener max. 150 caracteres.',
      'empresa_id.required' => 'El campo Oficina es obligatorio si el campo Otra Oficina esta vacio.',
      'empresa_id.exists' => 'El campo Oficina debe estar previamente registrado.',
      'lugarreu.required' => 'El campo Otra Oficina es obligatorio si el campo Oficina esta vacio.',
      'lugarreu.max' => 'El campo Otra Oficina debe contener max. 150 caracteres.',
      'asistentes.required' => 'El campo Asistentes es obligatorio.',
      'asistentes.exists' => 'El campo Asistentes debe estar previamente registrado.',
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
      'hora_inicio' => 'required|date_format:H:i|after_or_equal:08:30|before_or_equal:18:30|before:hora_fin',
      'hora_fin' => 'required|date_format:H:i|after_or_equal:08:30|before_or_equal:18:30|after:hora_inicio',
      'link_reu' => 'nullable|max:150',
      'empresa_id' => [
        'nullable',
        Rule::requiredIf(empty($request->get('lugarreu'))),
        'exists:empresas,id',
      ],
      'lugarreu' => [
        Rule::requiredIf(empty($request->get('empresa_id'))),
        'max:150',
      ],
      'asistentes' => 'required|exists:colaboradores,id'
    ], [
      'titulo.required' => 'El campo Título es obligatorio.',
      'titulo.max' => 'El campo titulo debe contener max. 50 caracteres.',
      'tipocita.required' => 'El campo Tipo Cita es obligatorio.',
      'tipocita.in' => 'El campo Tipo Cita solo puede ser: presencial, virtual',
      'descripcion.max' => 'El campo Descripcion debe contener max. 250 caracteres.',
      'fecha.required' => 'El campo Fecha es obligatorio.',
      'fecha.date_format' => 'El campo Fecha debe tener formato año/mes/dia',
      'hora_inicio.required' => 'El campo Hora Inicio es obligatorio.',
      'hora_inicio.date_format' => 'El campo Hora Inicio debe tener formato hora/minutos',
      'hora_inicio.after_or_equal' => 'El campo Hora Inicio debe ser mayor o igual a las 8:30 am',
      'hora_inicio.before_or_equal' => 'El campo Hora Inicio debe ser menor o igual a las 6:30 pm',
      'hora_inicio.before' => 'El campo Hora Inicio debe ser menor al campo Hora Fin',
      'hora_fin.required' => 'El campo Hora Fin es obligatorio.',
      'hora_fin.date_format' => 'El campo Hora Fin debe tener formato hora/minutos',
      'hora_fin.after_or_equal' => 'El campo Hora Fin debe ser mayor o igual a las 8:30 am',
      'hora_fin.before_or_equal' => 'El campo Hora Fin debe ser menor o igual a las 6:30 am',
      'hora_fin.after' => 'El campo Hora Fin debe ser mayor al campo Hora Inicio',
      'link_reu.max' => 'El campo Link debe contener max. 150 caracteres.',
      'empresa_id.required' => 'El campo Oficina es obligatorio si el campo Otra Oficina esta vacio.',
      'empresa_id.exists' => 'El campo Oficina debe estar previamente registrado.',
      'lugarreu.required' => 'El campo Otra Oficina es obligatorio si el campo Oficina esta vacio.',
      'lugarreu.max' => 'El campo Otra Oficina debe contener max. 150 caracteres.',
      'asistentes.required' => 'El campo Asistentes es obligatorio.',
      'asistentes.exists' => 'El campo Asistentes debe estar previamente registrado.',
    ]);

    if ($validator->fails()) {
      return response()->json(['messages' => $validator->errors()], 400);
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
