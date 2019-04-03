<?php

namespace App\Http\Requests\Enterprise;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnterprise extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:enterprises,email,' . $this->route('enterprise')->id,
            'identification_number' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Debe ingresar el nombre',
            'email.unique' => 'El email debe ser unico',
            'identification_number.required' => 'Debe ingresar el número de identificación',
            'identification_number.numeric' => 'El número de identificación debe ser numérico',        
        ];
    }
}
 