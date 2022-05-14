<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequerimientoRequest extends FormRequest
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


            'titulo' => 'required',
            'descripcion' => 'required',
            'prioridad'=>'alpha',
            'empresa_servicio_id' => 'integer',
            'usuarioencarg_id[]' => 'integer',
        ];
    }


    public function messages()

    {

        return[

            'titulo.required' => 'El título es un campo requerido.',
            'descripcion.required' => 'Debe ingresar una descripción.',
            'prioridad.alpha' => 'Debe seleccionar una prioridad.',
            'empresa_servicio_id.integer' => 'Debe seleccionar una empresa con servicio.',

            'usuarioencarg_id[].integer' => 'Debe asignar un encargado.',
        ];
    }

}
