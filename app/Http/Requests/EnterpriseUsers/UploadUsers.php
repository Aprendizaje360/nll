<?php

namespace App\Http\Requests\EnterpriseUsers;

use Illuminate\Foundation\Http\FormRequest;

class UploadUsers extends FormRequest
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
            'excel' => 'required', 
        ];
    }

    /**
     * Messages to be displayed for rules
     * @return null null
     */
    public function messages()
    {
        return [
            'excel.required' => 'Debe ingresar el excel',
        ];
    }
}
