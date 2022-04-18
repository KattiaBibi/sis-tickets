<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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

            'problema' => 'required',
            'detalle' => 'required',
            'empresa_servicio_id' => 'required|integer',

        ];
    }


    public function messages()

    {

        return[

            'problema.required' => 'Nombre es un campo requerido.',
            'detalle.required' => 'Apellidos es un campo requerido.',
            'empresa_servicio_id.required' => 'Debe seleccionar un servicio.',
            'empresa_servicio_id.integer' => 'Debe seleccionar un servicio.',


        ];
    }

}
