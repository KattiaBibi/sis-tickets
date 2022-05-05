<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

        return [
            //
            'nrodocumento' => 'required|min:8|max:8|unique:colaboradores,nrodocumento,' . $this->id,
            'nombres' => 'required',
            'apellidos' => 'required',
            'fechanacimiento' => 'required|before:-18 years',
            'direccion' => 'required',
            'telefono' => 'required',
            'empresa_area_id' => 'required|integer',
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
            'fechanacimiento.before' => 'Debes ser mayor de edad.',
            'direccion.required' => 'La dirección es un campo requerido.',
            'telefono.required' => 'El teléfono es un campo requerido.',
            'empresa_area_id.integer' => 'Debe seleccionar una ampresa con área.',


        ];
    }
}
