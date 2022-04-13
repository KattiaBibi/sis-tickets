<?php

namespace App\Http\Requests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //

            'empresa_id' => 'required|integer',
            'servicio_id' => 'required|integer',
        ];
    }

    public function messages(){

        return[

            'empresa_id.required' => '¡Debe elegir una empresa!',
            'servicio_id.required' => '¡Debe elegir un servicio!',
            'empresa_id.integer' => 'Debe seleccionar una empresa.',
            'servicio_id.integer' => 'Debe seleccionar un servicio.',

        ];
    }
}
