<?php

namespace App\Http\Requests;

use App\Servicio;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EmpresaServicioRequest extends FormRequest
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

  public function rules()
  {
    Validator::extend('custom_rule', function ($attribute, $value) {
      $id_empresa = request()->input('id_empresa');

      $query = Servicio::join('empresa_servicios', 'empresa_servicios.servicio_id', '=', 'servicios.id')
        ->where($attribute, $value)
        ->where('empresa_servicios.empresa_id', $id_empresa);

      return !$query->count();
    });

    return [
      'id_empresa' => 'required',
      'nombre' => 'required|custom_rule'
    ];
  }

  public function messages()
  {
    return [
      'id_empresa.required' => 'La empresa es un campo requerido',
      'nombre.required' => 'El nombre es un campo requerido',
      'nombre.custom_rule' => 'El servicio ya existe en esta empresa'
    ];
  }
}
