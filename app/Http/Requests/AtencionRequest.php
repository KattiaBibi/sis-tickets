<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtencionRequest extends FormRequest
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

            'usuario_colab_id'=>'required',
            'servicio_id' => 'required|integer',
            'prioridad_id' => 'required|integer',

        ];
    }


    public function messages(){


        return[
            'usuario_colab_id.required'=>'Debe elegir al menos un trabajador.',
            'servicio_id.integer' => 'Debe seleccionar un servicio.',
            'prioridad_id.integer' => 'Debe seleccionar una prioridad.',

        ];


    }
}
