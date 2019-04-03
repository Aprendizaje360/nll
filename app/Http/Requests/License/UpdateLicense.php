<?php

namespace App\Http\Requests\License;

use Illuminate\Foundation\Http\FormRequest;

use App\Entities\License;

use Carbon\Carbon;

class UpdateLicense extends FormRequest
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
            'intervention_id' => 'required',
        ];
    }

    public function messages()
    {
        return [    
            'intervention_id.required' => 'Debe ingresar una intervención'      
        ];
    }

    /**
     * Configure the validator instance.
     * Adds the required rule for expiration date and enable date. Enable dates need to be before the expiration_date
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) 
        {
            if ($this['expiration_date'] <= Carbon::now())
            {
                $validator->errors()->add('uses', 'La fecha de expiración no puede ser menor a la fecha y hora actual');
            }      

            $LBeingUpdated = $this->route('license');

            $license = License::where('intervention_id', $this['intervention_id'])
                               ->where('enterprise_id', $LBeingUpdated->enterprise->id)
                               ->first();


            if ($license->id != $LBeingUpdated->id)
            {
                $validator->errors()->add('uses', 'Ya existe una licencia con esa intervención. Si requiere más tiempo o más usos edite la otra');
            }

            if ($this['total_uses'] <= $LBeingUpdated->uses)
            {
                $validator->errors()->add('uses', 'El total de usos nuevo es menor o igual a los usos de la licencia');
            }
            
        });
    }
}
 