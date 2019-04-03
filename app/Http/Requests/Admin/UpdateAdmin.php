<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdmin extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //\Auth::guard('web_admin')->user()->can('update', $this->route('admin'));
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
            'email' => 'required|unique:users,email,' . $this->route('admin')->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Debe ingresar el nombre',
            'lastName.required' => 'Debe ingresar el apellido',
            'email.required' => 'Debe ingresar el e-mail',
            'email.unique' => 'El correo ya existe',             
        ];
    }
}
 