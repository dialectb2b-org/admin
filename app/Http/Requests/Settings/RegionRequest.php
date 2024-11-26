<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegionRequest extends FormRequest
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
        $rule_iso2_unique = Rule::unique('regions','iso2');
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rule_iso2_unique->ignore($this->region->id);
        }
       
        return [
            'name' => ['required','max:255'],
            'country_id' =>  ['required'],
            'iso2' =>  ['required',$rule_iso2_unique,'max:2'],
            'status' =>  ['nullable'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank.',
            'name.unique' => 'Name is already taken.',
            'name.max' => 'Name must not be greater than 255 characters.',
            'country_id.required' => 'Please select country.',
            'iso2.required' => 'Please enter iso2.',
            'iso2.max' => 'iso2 must not be greater than 2 characters.',
            'iso2.unique' => 'iso2 is already taken.',
        ];
    }
}
