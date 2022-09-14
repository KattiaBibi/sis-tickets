<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColaboradorRequest extends FormRequest
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
    $empresas_id = array_filter(request()->input('empresas.*.id'), fn ($id) => $id != '');

    return [
      'nrodocumento' => 'required|min:8|max:8|unique:colaboradores,nrodocumento,' . $this->id,
      'nombres' => 'required',
      'apellidos' => 'required',
      'fechanacimiento' => 'required|before:-18 years',
      'direccion' => 'required',
      'telefono' => 'required',
      'empresas' => 'required|array|min:1',
      'empresas.*' => 'required',
      'empresas.*.id_empresa_area' => 'required|exists:empresa_areas,id|distinct',
      'empresas.*.correo' => [
        'required',
        'email',
        'distinct',
        Rule::unique('colaborador_empresa_area', 'correo_corporativo')->where(function ($query) use ($empresas_id) {
          $query->whereNotIn('id', $empresas_id);
          return $query;
        })
      ],
    ];
  }


  public function messages()
  {
    return [
      'nrodocumento.unique' => '¡Colaborador con este DNI ya registrado!',
      'nrodocumento.required' => 'Campo nro. documento (DNI) obligatorio.',
      'nrodocumento.min' => 'Debe ingresar 8 números para DNI.',
      'nrodocumento.max' => 'Debe ingresar 8 números para DNI.',
      'nombres.required' => 'Nombre es un campo requerido.',
      'apellidos.required' => 'Apellidos es un campo requerido.',
      'fechanacimiento.required' => 'Fecha de nacimiento es un campo requerido.',
      'fechanacimiento.before' => 'Debe ser mayor de edad.',
      'direccion.required' => 'La dirección es un campo requerido.',
      'telefono.required' => 'El teléfono es un campo requerido.',
      'empresas.required' => 'El campo empresa(s) es requerido.',
      'empresas.array' => 'El campo empresa(s) debe ser un array.',
      'empresas.min' => 'El campo empresa(s) debe ser contener min. 1 registro.',
      'empresas.*' => 'El campo empresa(s) debe ser contener min. 1 registro.',
      'empresas.*.correo.required' => 'El campo correo es requerido.',
      'empresas.*.correo.email' => 'El campo correo debe ser un email valido.',
    ];
  }
}
