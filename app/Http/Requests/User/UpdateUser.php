<?php

namespace App\Http\Requests\User;

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
            'email' => 'required|unique:users,email,' . $this->route('user')->id,
            'telephone' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Debe ingresar el nombre',
            'lastName.required' => 'Debe ingresar el apellido',
            'telephone.required' => 'Debe ingresar un número de teléfono', 
            'telephone.numeric' => 'El telefono debe contener solo números',
            'email.required' => 'Debe ingresar el e-mail',
            'email.unique' => 'El correo ya existe',   
        ];
    }
}
 