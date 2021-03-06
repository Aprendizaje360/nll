<?php

namespace App\Http\Requests\Intervention;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIntervention extends FormRequest
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
            'title' => 'required|unique:interventions,title,' . $this->route('intervention')->id,
            'description' => 'required',
            'model_competences_id' => 'required',
            'welcome_text' => 'required',
            'introduction' => 'required',
            'case_introduction' => 'required',
            'final_text' => 'required',
            'support_mail' => 'required'
        ];
    }

    /**
     * Messages to be displayed for rules
     * @return null null
     */
    public function messages()
    {
        return [
            'title.required' => 'Debe ingresar el nombre',
            'title.unique' => 'El nombre ya existe',
            'description' => 'Debe ingresar la descripcion',
            'welcome_text' => 'Debe ingresar el texto de bienvenida',
            'introduction' => 'Debe ingresar la introducción',
            'case_introduction' => 'Debe ingresar la introduccion al caso específico',
            'final_text' => 'Debe ingresar el texto final',
            'welcome_text' => 'Debe ingresar el texto de bienvenida',
            'introduction' => 'Debe ingresar la introducción',
            'case_introduction' => 'Debe ingresar la introduccion al caso específico',
            'final_text' => 'Debe ingresar el texto final',
            'support_mail.required' => 'Debe ingresar el correo de'
        ];
    }
}
