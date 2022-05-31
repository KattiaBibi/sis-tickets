<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistorialFechaHoraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'fechahora' =>'required|date_format:Y-m-d H:i:s|after_or_equal:today',
            'motivo'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'fechahora.required' => 'La fecha es un campo requerido',
            'fechahora.date_format' => 'La fecha no tiene un formato correcto',
            'fechahora.after_or_equal' => 'La fecha y hora debe ser mayor igual a la actual',
            'motivo.required' => 'El motivo es un campo requerido',

    ];
    }
}
