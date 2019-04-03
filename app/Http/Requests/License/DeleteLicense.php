<?php

namespace App\Http\Requests\License;

use Illuminate\Foundation\Http\FormRequest;

class DeleteLicense extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //return \Auth::guard('web_License')->user()->can('delete', $this->route('License'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
