<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermisoRequest extends FormRequest
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
            'description' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es un campo requerido',
            'description.required' => 'La descripción es un campo requerido',

    ];
    }
}
