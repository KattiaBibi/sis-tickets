<?php

namespace App\Http\Controllers;

use App\Cita;

use App\DetalleCita;
use App\Http\Requests\CitaRequest;
use App\Mail\TestSendEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class CitaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  private $model;

  public function __construct()
  {
    $this->model = new Cita();

    $this->middleware('auth');

    $this->middleware('can:admin.reuniones.agregar')->only('store');
    $this->middleware('can:admin.reuniones.editar')->only('update');
    $this->middleware('can:admin.reuniones.eliminar')->only('destroy');
  }

  public function index()
  {
    $empresas = DB::table('empresas')->where('estado', '=', '1')->get();

    return view('cita.calendario', compact('empresas'));
  }

  public function getForFullCalendar()
  {
    $start = request('start');
    $end = request('end');
    $estado = request('estado');

    $citas = $this->model->index([
      'fecha_inicio' => $start,
      'fecha_fin' => $end,
      'estado' => $estado,
    ]);

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
  public function store(CitaRequest $request)
  {
    $input = $request->all();

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
    $cita = DB::table('citas')
      ->select(
        "citas.id AS id",
        "citas.titulo as titulo",
        "citas.descripcion as descripcion",
        "citas.fecha as fecha",
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

    $cita->asistentes = DB::table('detalle_citas')
      ->select(
        "detalle_citas.usuario_colab_id as id",
        "colaboradores.nombres AS nombres",
        "colaboradores.apellidos AS apellidos",
        "detalle_citas.confirmation AS confirmation",
        "detalle_citas.confirmation_at AS confirmation_at"
      )
      ->join('colaboradores', 'colaboradores.id', '=', 'detalle_citas.usuario_colab_id')
      ->where('cita_id', $id)
      ->get()->all();

    return response()->json([
      "messages" => "Resource retrieved successfully.",
      "data" => $cita
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
  public function update(CitaRequest $request, $id)
  {
    $cita = Cita::find($id);
    if (is_null($cita)) {
      return response()->json(['errors' => 'resource not found.'], 404);
    }

    if (auth()->user()->id != $cita->usuario_id) {
      return response()->json(['errors' => 'No esta autorizado a editar esta reunion.'], 403);
    }

    if (strtotime($cita->fecha) < strtotime(date('Y-m-d'))) {
      return response()->json(['errors' => 'No se pueden editar reuniones pasadas.'], 400);
    }

    $input = $request->all();

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

  public function sendEmail()
  {
    $cita = $this->model->index(['id_cita' => 1])[0];

    // dd($cita);

    foreach ($cita->asistentes as $asistente) {
      Mail::to($asistente->email)->send(new TestSendEmail($cita, $asistente));
    }
  }
}
