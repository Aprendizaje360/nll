<?php

namespace App\Http\Requests\EnterpriseUsers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'lastName' => 'required',
            'email_company' => 'required|unique:users,email_company,' . $this->route('user')->id,
            'area' => 'required',
            'sector' => 'required',
            'gender' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'lastName.required' => 'Los apellidos son requeridos',
            'email_company.required' => 'El correo de la compañia es requerido',
            'email_company.unique' => 'El correo de la compañia ya existe',
            'area.required' => 'El área es requerida',
            'sector.required' => 'El sector es requerido',
            'gender' => 'El género es requerido',
        ];
    }
}
 