<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
            'ruc'=>'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
        ];
    }


    public function messages()
{
    return [
        'ruc.required'=>'El ruc es un campo requerido',
        'nombre.required' => 'El nombre es un campo requerido',
        'direccion.required' => 'La dirección es un campo requerido',
        'telefono.required' => 'El teléfono es un campo requerido', 

];
}
}
