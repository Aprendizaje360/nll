<?php

namespace App\Http\Requests\Competence;

use Illuminate\Foundation\Http\FormRequest;

//Entities
use App\Entities\ModelCompetences;
use App\Entities\Competence;

class UpdateCompetence extends FormRequest
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
            'label' => 'required',
            'description' => 'required',
            'description_m_1' => 'required',
            'description_h_1' => 'required',
            'description_m_2' => 'required',
            'description_h_2' => 'required',
            'description_m_3' => 'required',
            'description_h_3' => 'required',
            'description_m_4' => 'required',
            'description_h_4' => 'required'
        ];
    }

    /**
     * Messages to be displayed for rules
     * @return null null
     */
    public function messages()
    {
        return [
            'label.required' => 'Debe ingresar el nombre',
            'description' => 'Debe ingresar la descripcion',
            'description_m_1' => 'Debe ingresar la descripción máquina de nivel 1',
            'description_h_1' => 'Debe ingresar la descripción humana de nivel 1',
            'description_m_2' => 'Debe ingresar la descripción máquina de nivel 2',
            'description_h_2' => 'Debe ingresar la descripción humana de nivel 2',
            'description_m_3' => 'Debe ingresar la descripción máquina de nivel 3',
            'description_h_3' => 'Debe ingresar la descripción humana de nivel 3',
            'description_m_4' => 'Debe ingresar la descripción máquina de nivel 4',
            'description_h_4' => 'Debe ingresar la descripción humana de nivel 4'
        ];
    }


    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) 
        {
            $modelCompetences = ModelCompetences::find($this['model_competences_id']);

            $typeId = $this->route('competence')->competence_type_id;

            $name = slugify($this['label']);

            if (Competence::where('name', $name)->first() && !Competence::where('label', $this['label'])->first())
            {
                $validator->errors()->add('label', 'El nombre ya esta agregado con otra forma');
            }

            $this->merge(['name' => $name]);

            if ($modelCompetences->competences()->where('competence_type_id', 1)->count() == 4 
                && $this['competence_type_id'] == 1 
                && $typeId == 2)
            {
                $validator->errors()->add('label', 'El modelo de competencias ya tiene 4 competencias transversales');
            }

            if ($modelCompetences->competences()->where('competence_type_id', 2)->count() == 4  
                && $this['competence_type_id'] == 2
                && $typeId == 1)
            {
                $validator->errors()->add('label', 'El modelo de competencias ya tiene 4 competencias funcionales');
            }
        });
    }
}
