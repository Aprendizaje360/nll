<?php

namespace App\Http\Requests\Enterprise;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnterprise extends FormRequest
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
            'email' => 'required|unique:users',
            'identification_number' => 'required|numeric',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',   
        ];
    }

    /**
     * Messages to be displayed for rules
     * @return null null
     */
    public function messages()
    {
        return [
            'name.required' => 'Debe ingresar el nombre',
            'email.required' => 'Debe ingresar el e-mail',
            'email.unique' => 'El correo ya existe',      
            'identification_number.required' => 'Debe ingresar el número de identificación',
            'identification_number.numeric' => 'El número de identificación debe ser numérico',       
            'password.required' => 'Debe ingresar el password',
            'password_confirmation.required' => 'Debe ingresar la confirmacion del password',
            'password_confirmation.same' => 'Las contraseñas ingresasdas no coinciden',
        ];
    }
}
