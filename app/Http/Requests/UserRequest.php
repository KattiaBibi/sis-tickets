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
            'email' => 'required|unique:users,email,' . $this->id,
            'password' => 'required|max:20|min:4',
            'colaborador_id'=>'required|integer',
        ];
    }



    public function messages()
{
    return [
        'name.unique' => '¡Usuario con este nombre ya registrado!',
        'name.required' => 'El nombre es un campo requerido.',
        'email.unique' => '¡Usuario con este correo ya registrado!',
        'email.required' => 'El email es un campo requerido.',
        'password.required' => 'La contraseña es un campo requerido.',
        'password.max' => 'La contraseña debe contener menos de 20 carácteres.',
        'password.min' => 'La contraseña debe contener más de 4 carácteres.',
        'colaborador_id.integer' => 'Debe seleccionar un colaborador.',

];
}
}
