<?php

namespace App\Http\Requests;

use App\Cita;
use App\DetalleCita;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CitaRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {

    Validator::extend('custom_rule', function ($attribute, $value, $parameters, $validator) {

      $request = request()->all();

      $asistentes = $request['asistentes'];

      if (request()->input('id')) {
        $asistentesDB = [];
        if (isset($request['id'])) {
          $detalleCita = DetalleCita::where('cita_id', $request['id'])->get()->all();
          foreach ($detalleCita as $value) {
            $asistentesDB[] = $value->usuario_colab_id;
          }
        }
        $asistentes = array_diff($asistentes, $asistentesDB);
      }

      $query = Cita::select(
        DB::raw("CONCAT(colaboradores.nombres, ' ', colaboradores.apellidos) AS nom_ape_colaborador")
      )
        ->join('detalle_citas', 'detalle_citas.cita_id', '=', 'citas.id')
        ->join('users', 'detalle_citas.usuario_colab_id', '=', 'users.id')
        ->join('colaboradores', 'colaboradores.id', '=', 'users.colaborador_id')
        ->whereIn('detalle_citas.usuario_colab_id', $asistentes)
        ->where(function($query) use ($request) {
          $query->where(DB::raw("TIMESTAMP(citas.fecha, citas.hora_inicio)"), '>=', $request['fecha'] . ' ' . $request['hora_inicio']);
          $query->orWhere(DB::raw("TIMESTAMP(citas.fecha, citas.hora_fin)"), '>=', $request['fecha'] . ' ' . $request['hora_inicio']);
        })
        ->orWhere(function($query) use ($request) {
          $query->where(DB::raw("TIMESTAMP(citas.fecha, citas.hora_inicio)"), '>=', $request['fecha'] . ' ' . $request['hora_fin']);
          $query->orWhere(DB::raw("TIMESTAMP(citas.fecha, citas.hora_fin)"), '>=', $request['fecha'] . ' ' . $request['hora_fin']);
        });

      $customMessage = "";

      foreach ($query->get()->all() as $value) {
        $customMessage .= $value->nom_ape_colaborador . ', ';
      } 

      $validator->addReplacer(
        'custom_rule',
        function ($message, $attribute, $rule, $parameters) use ($customMessage) {
          return \str_replace(':custom_message', $customMessage, $message);
        }
      );

      return empty($asistentes) || !$query->count();
      // return false;
    }, 'Los asistentes :custom_message ya tienen reuniones agendadas en este horario.');

    return [
      'titulo' => 'required|max:50',
      'tipocita' => [
        'required',
        Rule::in(['presencial', 'virtual'])
      ],
      'descripcion' => 'nullable|max:250',
      'fecha' => [
        'required',
        // Rule::requiredIf(empty(request()->input('_method'))),
        'date_format:Y-m-d',
        'after_or_equal:today'
      ],
      'hora_inicio' => 'required|date_format:H:i|before:hora_fin',
      'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
      'link_reu' => 'nullable|max:150',
      'empresa_id' => [
        'nullable',
        Rule::requiredIf(empty(request()->input('lugarreu'))),
        'exists:empresas,id',
      ],
      'lugarreu' => [
        Rule::requiredIf(empty(request()->input('empresa_id'))),
        'max:150',
      ],
      'asistentes' => 'required|exists:colaboradores,id|custom_rule'
    ];
  }

  public function messages()
  {
    return [
      'titulo.required' => 'El campo Título es obligatorio.',
      'titulo.max' => 'El campo titulo debe contener max. 50 caracteres.',
      'tipocita.required' => 'El campo Tipo Cita es obligatorio.',
      'tipocita.in' => 'El campo Tipo Cita solo puede ser: presencial, virtual',
      'descripcion.max' => 'El campo Descripcion debe contener max. 250 caracteres.',
      'fecha.required' => 'El campo Fecha es obligatorio.',
      'fecha.after_or_equal' => 'El campo Fecha no puede ser en el pasado.',
      'fecha.date_format' => 'El campo Fecha debe tener formato año/mes/dia',
      'hora_inicio.required' => 'El campo Hora Inicio es obligatorio.',
      'hora_inicio.date_format' => 'El campo Hora Inicio debe tener formato hora/minutos',
      'hora_inicio.before' => 'El campo Hora Inicio debe ser menor al campo Hora Fin',
      'hora_fin.required' => 'El campo Hora Fin es obligatorio.',
      'hora_fin.date_format' => 'El campo Hora Fin debe tener formato hora/minutos',
      'hora_fin.after' => 'El campo Hora Fin debe ser mayor al campo Hora Inicio',
      'link_reu.max' => 'El campo Link debe contener max. 150 caracteres.',
      'empresa_id.required' => 'El campo Oficina es obligatorio si el campo Otra Oficina esta vacio.',
      'empresa_id.exists' => 'El campo Oficina debe estar previamente registrado.',
      'lugarreu.required' => 'El campo Otra Oficina es obligatorio si el campo Oficina esta vacio.',
      'lugarreu.max' => 'El campo Otra Oficina debe contener max. 150 caracteres.',
      'asistentes.required' => 'El campo Asistentes es obligatorio.',
      'asistentes.exists' => 'El campo Asistentes debe estar previamente registrado.',
    ];
  }
}
