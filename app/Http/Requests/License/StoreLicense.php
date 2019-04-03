<?php

namespace App\Http\Requests\License;

use Illuminate\Foundation\Http\FormRequest;

//Entities
use App\Entities\Enterprise;
use App\Entities\Intervention;
use App\Entities\License;

use Carbon\Carbon;

class StoreLicense extends FormRequest
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
            'total_uses' => 'required',
            'expiration_date' => 'required',
            'intervention_id' => 'required',   
        ];
    }

    /**
     * Messages to be displayed for rules
     * @return null null
     */
    public function messages()
    {
        return [
            'total_uses.required' => 'Debe ingresar los usos',
            'expiration_date.required' => 'Debe ingresar una fecha de expiración',              
            'intervention_id.required' => 'Debe ingresar una intervención'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) 
        {
            if ($this['expiration_date'] <= Carbon::now())
            {
                $validator->errors()->add('uses', 'La fecha de expiración no puede ser menor a la fecha y hora actual');
            }      

            $intervention = Intervention::find($this['intervention_id']);

            $enterprise = Enterprise::find($this['enterprise_id']);

            $licenses = License::where('intervention_id', $this['intervention_id'])
                               ->where('enterprise_id', $this['enterprise_id'])
                               ->get();

            if (!$licenses->isEmpty())
            {
                $validator->errors()->add('uses', 'Ya existe una licencia con esa intervención. Si requiere más tiempo o más usos editela');
            }
        
            $this->merge(['uses' => 0]);
        });

    }
}
