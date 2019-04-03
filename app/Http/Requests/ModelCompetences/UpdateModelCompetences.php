<?php

namespace App\Http\Requests\ModelCompetences;

use Illuminate\Foundation\Http\FormRequest;

class UpdateModelCompetences extends FormRequest
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
            'name' => 'required|unique:model_competences,name,' . $this->route('modelCompetences')->id,
            'description' => 'required'
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
            'name.unique' => 'El nombre ya existe',
            'description' => 'Debe ingresar la descripcion'
        ];
    }
}
