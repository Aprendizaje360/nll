<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'telephone' => 'required|numeric',
            'email' => 'required|unique:users',
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
            'lastName.required' => 'Debe ingresar el apellido',
            'telephone.required' => 'Debe ingresar el número de teléfono',
            'telephone.numeric' => 'El telefono debe contener solo números',
            'email.required' => 'Debe ingresar el e-mail',
            'email.unique' => 'El correo ya existe',         
            'password.required' => 'Debe ingresar el password',
            'password_confirmation.required' => 'Debe ingresar la confirmacion del password',
            'password_confirmation.same' => 'Las contraseñas ingresasdas no coinciden', 
        ];
    }
}
