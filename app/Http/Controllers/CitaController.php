<?php

namespace App\Http\Controllers;

use App\Cita;

use App\DetalleCita;
use App\Http\Requests\CitaRequest;
use App\Mail\CitaEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;

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

    $citas = $this->model->index(null, null, [
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
   * @param  \Illuminate\Http\Request  $idsAsistentes
   * @return \Illuminate\Http\Response
   */
  public function store(CitaRequest $idsAsistentes)
  {
    $input = $idsAsistentes->all();

    $input['usuario_id'] = auth()->user()->id;
    $input['estado'] = 'pendiente';

    DB::transaction(function () use ($input) {
      $cita = Cita::create($input);
      $detallesCita = [];
      foreach ($input['asistentes'] as $asistente) {
        array_push(
          $detallesCita,
          [
            'cita_id' => $cita->id,
            'usuario_colab_id' => $asistente
          ]
        );
      }
      DetalleCita::insert($detallesCita);
      $cita = $this->model->index(null, null, ['id_cita' => $cita->id])[0];
      $this->sendEmail($cita, $cita->asistentes, 'INVITACION');
      $this->sendWsp(null, 'invitacion', $cita);
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
    if (is_null(Cita::find($id))) {
      return response()->json(['errors' => 'resource not found.'], 404);
    }

    return response()->json([
      "messages" => "Resource retrieved successfully.",
      "data" => $this->model->index(null, null, ['id_cita' => $id])[0]
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
   * @param  \Illuminate\Http\Request  $idsAsistentes
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
      return response()->json(['no_autorizado' => 'No estas autorizado a editar esta reunion.'], 403);
    }

    if (strtotime($cita->fecha) < strtotime(date('Y-m-d'))) {
      return response()->json(['errors' => ['fecha' => 'No se pueden editar reuniones pasadas.']], 422);
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
    
    $idsAsistentes = $this->getIdsAsistentesPorTipoEnvioEmail($id, $input['asistentes']);
    $asistentesParaEliminacion = $this->getAsistentesPorTipoDeEnvioEmail($id, $idsAsistentes)['paraEliminacion'];
    
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

    $citaActual = $this->model->index(null, null, ['id_cita' => $id])[0];
    $asistentes = $this->getAsistentesPorTipoDeEnvioEmail($id, $idsAsistentes);
    
    $asistentes['paraEliminacion'] = $asistentesParaEliminacion;
    
    $this->sendEmail($citaActual, $asistentes['paraInvitacion'], 'INVITACION');
    $this->sendEmail($citaActual, $asistentes['paraReprogramacion'], 'REPROGRAMACION');
    $this->sendEmail($citaActual, $asistentes['paraEliminacion'], 'ELIMINACION');

    $this->sendWsp(null, 'reprog', $citaActual);

    return response()->json([
      "messages" => "Resource updated successfully.",
      "data" => $input
    ]);
  }

  private function getIdsAsistentesPorTipoEnvioEmail($idCita, $idsAsistentes)
  {
    $idsAsistentesActuales = array_map(function ($asistente) {
      return $asistente->asistente_id;
    }, $this->model->index(null, null, ['id_cita' => $idCita])[0]->asistentes);
    
    $idsInvitacion = array_diff($idsAsistentes, $idsAsistentesActuales);
    $idsEliminacion = array_diff($idsAsistentesActuales, $idsAsistentes);
    $idsReprogramacion = array_diff($idsAsistentesActuales, $idsEliminacion);

    return [
      'paraInvitacion' => $idsInvitacion,
      'paraEliminacion' => $idsEliminacion,
      'paraReprogramacion' => $idsReprogramacion,
    ];
  }
    
  private function getAsistentesPorTipoDeEnvioEmail($idCita, $idsAsistentes)
  {
    $paraInvitacion = $this->getAsistentesIn($idsAsistentes['paraInvitacion'],  $idCita);
    $paraEliminacion = $this->getAsistentesIn($idsAsistentes['paraEliminacion'], $idCita);
    $paraReprogramacion = $this->getAsistentesIn($idsAsistentes['paraReprogramacion'], $idCita);

    return [
      'paraInvitacion' => $paraInvitacion,
      'paraEliminacion' => $paraEliminacion,
      'paraReprogramacion' => $paraReprogramacion,
    ];
  }
    
  private function getAsistentesIn($ids, $idCita)
  {
    return  DB::table('colaboradores')
      ->select(
        "colaboradores.id AS id_colaborador",
        "detalle_citas.id as detalle_cita_id",
        "colaboradores.nombres AS nombres",
        "colaboradores.apellidos AS apellidos",
        "users.email AS email")
      ->join('detalle_citas', 'colaboradores.id', '=', 'detalle_citas.usuario_colab_id', 'left')
      ->join('users', 'users.colaborador_id', '=', 'colaboradores.id', 'left')
      ->whereIn('colaboradores.id', $ids)
      ->where('detalle_citas.cita_id', $idCita)
      ->get()->all();
  }

  public function reenviarEmail()
  {
    $idCita = request()->input('id_cita');
    $id_asistente = request()->input('id_asistente');

    $this->sendEmail(
      $this->model->index(null, null, ['id_cita' => $idCita])[0],
      $this->getAsistentesIn([$id_asistente], $idCita),
      'INVITACION'
    );

    return response()->json([
      "messages" => "Email enviado con exito.",
    ], 200);
  }

  private function sendEmail($cita, $asistentes, $tipoAsunto)
  {
    foreach ($asistentes as $asistente) {
      Mail::to($asistente->email)->send(new CitaEmail($cita, $asistente, $tipoAsunto));
    }
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

    $citaActual = $this->model->index(null, null, ['id_cita' => $id])[0];

    DB::transaction(function () use ($id, $cita) {
      DetalleCita::where('cita_id', '=', $id)->delete();
      $cita->delete();
    });

    $this->sendEmail($citaActual, $citaActual->asistentes, 'ELIMINACION');
    $this->sendWsp(null, 'eliminacion', $citaActual);

    return response()->json([
      "messages" => "Resource deleted successfully.",
      "data" => $cita
    ]);
  }

  public function confirmarAsistencia()
  {
    $validation = Validator::make(request()->all(), [
      'respuesta' => ['required', Rule::in(['SI', 'NO'])],
      'detalle_cita_id' => 'required|exists:detalle_citas,id',
      'hash' => 'required',
    ]);

    if ($validation->fails()) {
      return "¡Ocurrio un error en la validación, vuelva a intentarlo!";
    }

    $detalleCita = DetalleCita::find(request()->input('detalle_cita_id'));

    if ($detalleCita->confirmation != null) {
      return "¡Su confirmación ya fue enviada!";
    }

    if (!password_verify(request()->input('detalle_cita_id'), request()->input('hash'))) {
      return "¡Ocurrio un error con el hash, vuelva a intentarlo!";
    }

    $detalleCita->confirmation = request()->input('respuesta') === 'SI' ? 1 : 0;
    $detalleCita->confirmation_at = date('Y-m-d H:i:s');
    $detalleCita->save();

    return "¡Gracias, su confirmación fue registrada!";
  }

  private function sendWsp($id, $accion = 'invitacion', $cita = null)
  {
    $reunion = ($id !== null) ? $this->model->index(0, 0, [], ['id_cita' => $id])[0] : $cita;
    
    $accionText = ($accion === 'invitacion') ? 'SE TE ASIGNO A LA REUNIÓN' : ($accion === 'reprog' ? 'SE REPROGRAMO LA REUNIÓN' : 'SE TE ELIMINO DE LA REUNIÓN');

    $recipients = array_map(function($asistente) use ($reunion, $accionText) {

      $fecha = date('d/m/Y', strtotime($reunion->fecha));
      $horaInicio = date('h:i A', strtotime($reunion->hora_inicio));
      $horaFin = date('h:i A', strtotime($reunion->hora_fin));

      $message = "👉 HOLA, *$asistente->nombres $asistente->apellidos*, $accionText: \n ✅ *SOLICITANTE:* $reunion->registrado_por \n ✅ *TITULO:* $reunion->titulo \n 📅 *FECHA:* $fecha \n 📅 *HORA INICIO:* $horaInicio \n 📅 *HORA FIN:* $horaFin \n ✅ *TIPO:* $reunion->tipo \n ✅ *EMPRESA:* $reunion->descripcion_empresa \n ***Revisa tu correo $asistente->email para mas información***";

      return [
        'message' => $message,
        'phoneNumber' => $asistente->telefono
      ];

    }, $reunion->asistentes);

    // dd($recipients);

    $this->sendWhatsappMessages($recipients);
  }

  /**
     * Send Whatsapp Messages
     *
     * @param  array $recipients Example: [message => 'Test', phoneNumber => '123456789']
     * @return array $responses
     */

    private function sendWhatsappMessages(array $recipients)
    {
        $apiURL = 'http://localhost:3000/api/v1/sendMessage';
        // $apiURL = 'https://my-whatsapp-client.herokuapp.com/api/v1/sendMessage';
        // $apiURL = 'https://whatsapp-client-production.up.railway.app/api/v1/sendMessage';

        $promises = [];

        $client = new Client();

        foreach ($recipients as $recipient) {
            $promises[] = $client->postAsync($apiURL, [
                'json' => $recipient
            ]);
        }

        $responses = Utils::unwrap($promises);

        return $responses;
    }
}
