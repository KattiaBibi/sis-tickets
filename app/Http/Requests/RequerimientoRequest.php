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
            //

            // 'titulo' => 'required',
            // 'descripcion' => 'required',
            // // 'avance'=>'required',
            // 'prioridad'=>'required',
            // // 'estado'=>'required',
            // 'empresa_servicio_id' => 'required|integer',
            // // 'usuarioregist_id' => 'required|integer',
            // 'usuarioencarg_id' => 'required|integer',
        ];
    }


    // public function messages()

    // {

    //     return[

    //         'titulo.required' => 'El nombre es un campo requerido.',
    //         'descripcion.required' => 'Debe ingresar una descripción.',

    //         'prioridad.required' => 'Debe seleccionar una prioridad.',
    //         // 'estado.required' => 'Debe seleccionar un estado.',
    //         'empresa_servicio_id.required' => 'Debe seleccionar una empresa con servicio.',
    //         'empresa_servicio_id.integer' => 'Debe seleccionar una empresa con servicio.',

    //         'usuarioencarg_id.required' => 'Debe asignar un encargado.',
    //         'usuarioencarg_id.integer' => 'Debe asignar un encargado.',
    //     ];
    // }

}
