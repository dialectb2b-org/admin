<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => ['nullable'],
            'email' => ['nullable','email'],
            'phone' => ['nullable','numeric'],
            'address' => ['nullable'],
            'pobox' => ['nullable'],
            'fax' => ['nullable'],
            'zone' => ['nullable'],
            'country_id' => ['nullable'],
            'unit' =>  ['nullable'],
            'street' => ['nullable','numeric'],
            'building' => ['nullable','numeric'],
            'region_id' => ['nullable','numeric'],
            'domain' => ['nullable'],
            'status' => ['nullable'],
            'logo' => ['nullable'],
            'added_by' => ['nullable'],
            'approval_status' => ['nullable'],
            'isVerified' => ['nullable'],
            'isDocVerified' => ['nullable'],
            
        ];
    }
}
