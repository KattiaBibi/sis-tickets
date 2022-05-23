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

            'name' => 'required|unique:users,name,' . $this->id,
            'email' => 'required|unique:users,email,' . $this->id,
            'colaborador_id'=>'integer|unique:users,colaborador_id,' . $this->id,
            'role'=>'integer'

        ];
    }



    public function messages()
{
    return [

        'name.unique' => '¡Usuario con este nombre ya registrado!',
        'name.required' => 'El nombre es un campo requerido.',
        'email.unique' => '¡Usuario con este correo ya registrado!',
        'email.required' => 'El email es un campo requerido.',
        'colaborador_id.unique' => '¡Usuario con este colaborador ya registrado!',
        'colaborador_id.integer' => 'Debe seleccionar un colaborador.',
        'role.integer' => 'Debe seleccionar un rol.'

];
}
}
