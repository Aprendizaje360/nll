<?php

namespace App\Http\Requests\EnterpriseClerks;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClerk extends FormRequest
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
            'password_confirmation' => 'same:password', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Debe ingresar el nombre',
            'email.unique' => 'El email debe ser unico',
            'password_confirmation.same' => 'Las contraseñas ingresasdas no coinciden',
        ];
    }
}
 