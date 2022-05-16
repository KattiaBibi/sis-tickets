<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

            'name' => 'required|unique:users,name,' . $this->id,
            'email' => 'required',
            'password' => 'required',
            'colaborador_id'=>'required|integer',
        ];
    }



    public function messages()
{
    return [
        'name.unique' => '¡Usuario con este nombre ya registrado!',
        'name.required' => 'El nombre es un campo requerido.',
        'email.required' => 'El email es un campo requerido.',
        'password.required' => 'La contraseña es un campo requerido.',
        'colaborador_id.integer' => 'Debe seleccionar un colaborador.',

];
}
}
