<?php

namespace App\Http\Requests\Sequence;

use Illuminate\Foundation\Http\FormRequest;

//Entities
use App\Entities\Sequence;

class StoreSequence extends FormRequest
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
            'title' => 'required|unique:sequences',
            'order' => 'required|unique:sequences',
            'description' => 'required',
            'background_image' => 'required',
            'transversal_competence_id' => 'required',
            'video_1' => 'required',
            'transversal_question' => 'required',
            'transversal_alt_level_1' => 'required',
            'transversal_alt_level_2' => 'required',
            'transversal_alt_level_3' => 'required',
            'transversal_alt_level_4' => 'required',
            'functional_competence_id' => 'required',
            'video_2' => 'required',
            'reflexive_text' => 'required',
            'functional_question' => 'required',
            'functional_category_1' => 'required',
            'functional_alt_level_1_1' => 'required',
            'functional_alt_level_1_2' => 'required',
            'functional_alt_level_1_3' => 'required',
            'functional_alt_level_1_4' => 'required',
            'functional_category_2' => 'required',
            'functional_alt_level_2_1' => 'required',
            'functional_alt_level_2_2' => 'required',
            'functional_alt_level_2_3' => 'required',
            'functional_alt_level_2_4' => 'required',
            'functional_category_3' => 'required',
            'functional_alt_level_3_1' => 'required',
            'functional_alt_level_3_2' => 'required',
            'functional_alt_level_3_3' => 'required',
            'functional_alt_level_3_4' => 'required',
            'functional_category_4' => 'required',
            'functional_alt_level_4_1' => 'required',
            'functional_alt_level_4_2' => 'required',
            'functional_alt_level_4_3' => 'required',
            'functional_alt_level_4_4' => 'required'
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
            'title.unique' => 'Debe ingresar el nombre',
            'order.required' => 'Debe ingresar el orden',
            'order.unique' => 'Este número de secuencia ya existe',
            'description.required' => 'Debe ingresar la descripcion',
            'background_image.required' => 'Se debe ingresar una imagen de fondo',
            'transversal_competence_id.required' => 'Debe ingersar una competencia transversal',
            'video_1.required' => 'Debe ingresar el primer video',
            'transversal_question.required' => 'Debe ingresar una pregunta para la competencia transversal',
            'transversal_alt_level_1.required' => 'Debe ingresar la primera alternativa transversal',
            'transversal_alt_level_2.required' => 'Debe ingresar la segunda alternativa transversal',
            'transversal_alt_level_3.required' => 'Debe ingresar la tercera alternativa transversal',
            'transversal_alt_level_4.required' => 'Debe ingresar la cuarta alternativa transversal',
            'functional_competence_id.required' => 'Debe ingersar una competencia funcional',
            'video_2.required' => 'Debe ingresar el primer video',
            'reflexive_text.required' => 'Debe ingresar un texto de reflexion',
            'functional_question.required' => 'Debe ingresar una pregunta para la competencia funcional',
            'functional_category_1.required' => 'Debe ingresar la categoria asociada al primer grupo',
            'functional_alt_level_1_1.required' => 'Debe ingresar la alternativa 1-1 funcional',
            'functional_alt_level_1_2.required' => 'Debe ingresar la alternativa 1-2 funcional',
            'functional_alt_level_1_3.required' => 'Debe ingresar la alternativa 1-3 funcional',
            'functional_alt_level_1_4.required' => 'Debe ingresar la alternativa 1-4 funcional',
            'functional_category_2.required' => 'Debe ingresar la categoria asociada al segundo grupo',
            'functional_alt_level_2_1.required' => 'Debe ingresar la alternativa 2-1 funcional',
            'functional_alt_level_2_2.required' => 'Debe ingresar la alternativa 2-2 funcional',
            'functional_alt_level_2_3.required' => 'Debe ingresar la alternativa 2-3 funcional',
            'functional_alt_level_2_4.required' => 'Debe ingresar la alternativa 2-4 funcional',
            'functional_category_3.required' => 'Debe ingresar la categoria asociada al tercer grupo',
            'functional_alt_level_3_1.required' => 'Debe ingresar la alternativa 3-1 funcional',
            'functional_alt_level_3_2.required' => 'Debe ingresar la alternativa 3-2 funcional',
            'functional_alt_level_3_3.required' => 'Debe ingresar la alternativa 3-3 funcional',
            'functional_alt_level_3_4.required' => 'Debe ingresar la alternativa 3-4 funcional',
            'functional_category_4.required' => 'Debe ingresar la categoria asociada al cuarto grupo',
            'functional_alt_level_4_1.required' => 'Debe ingresar la alternativa 4-1 funcional',
            'functional_alt_level_4_2.required' => 'Debe ingresar la alternativa 4-2 funcional',
            'functional_alt_level_4_3.required' => 'Debe ingresar la alternativa 4-3 funcional',
            'functional_alt_level_4_4.required' => 'Debe ingresar la alternativa 4-4 funcional'
        ];
    }

 }
