<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class RequerimientoRespuestaRequest extends FormRequest
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
        $request = request();
        return [
            'pdf' => [
                Rule::requiredIf(function () use ($request) {
                    return $request->method == 'POST';
                }),
                'mimes:pdf',
                'max:5120'
            ],
            'descripcion' => 'nullable|max:1000',
            'requerimiento_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'pdf.required' => 'El campo pdf es requerido',
            'pdf.mimes' => 'El campo pdf debe ser formato PDF',
            'pdf.max' => 'El campo pdf deber ser max. 5mb',
            'descripcion.max' => 'El campo descripcion deber ser max. 1000 caracteres',
            'requerimiento_id.required' => 'El campo requerimiento_id es requerido',
        ];
    }
}
