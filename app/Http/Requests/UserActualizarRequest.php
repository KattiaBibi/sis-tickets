<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserActualizarRequest extends FormRequest
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

            'name' => 'required',
            'email' => 'required',
            'colaborador_id'=>'required|integer',
        ];
    }



    public function messages()
{
    return [
        'name.required' => 'El nombre es un campo requerido.',
        'email.required' => 'El email es un campo requerido.',
        'colaborador_id.integer' => 'Debe seleccionar una prioridad.',

];
}
}
