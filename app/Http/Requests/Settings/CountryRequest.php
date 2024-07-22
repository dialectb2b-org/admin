<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CountryRequest extends FormRequest
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
        $rule_name_unique = Rule::unique('countries', 'name');
        $rule_iso3_unique = Rule::unique('countries', 'iso3');
        $rule_iso2_unique = Rule::unique('countries', 'iso2');
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rule_name_unique->ignore($this->country->id);
            $rule_iso3_unique->ignore($this->country->id);
            $rule_iso2_unique->ignore($this->country->id);
        }
        return [
            'name' => ['required', $rule_name_unique ,'max:255'],
            'iso3' =>  ['required', $rule_iso3_unique,'max:3'],
            'iso2' =>  ['required', $rule_iso2_unique,'max:2'],
            'numeric_code' =>  ['nullable','max:16'],
            'phonecode'    =>  ['required','max:10'],
            'capital'      =>  ['nullable','max:255'],
            'currency'     =>  ['nullable','max:255'],
            'currency_name'=>  ['nullable','max:255'],
            'currency_symbol' =>  ['nullable','max:10'],
            'tld'             =>  ['nullable','max:10'],
            'native'          =>  ['nullable','max:255'],
            'status'          =>  ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank.',
            'name.unique' => 'Name is already taken.',
            'name.max' => 'Name must not be greater than 255 characters.',
            'iso3.required' => 'Please enter iso3.',
            'iso3.max' => 'iso3 must not be greater than 2 characters.',
            'iso3.unique' => 'iso3 is already taken.',
            'iso2.required' => 'Please enter iso2.',
            'iso2.max' => 'iso2 must not be greater than 2 characters.',
            'iso2.unique' => 'iso2 is already taken.',
            'phonecode.required' => 'Phonecode cannot be blank.',
            'numeric_code.max' => 'Numeric code must not be greater than 16 characters.',
            'phonecode.max' => 'Phonecode code must not be greater than 10 characters.',
            'capital.max' => 'Capital must not be greater than 255 characters.',
            'currency.max' => 'Currency must not be greater than 255 characters.',
            'currency_name.max' => 'Currency name must not be greater than 255 characters.',
            'currency_symbol.max' => 'Currency symbol must not be greater than 10 characters.',
            'tld.max' => 'tld must not be greater than 10 characters.',
            'native.max' => 'Native must not be greater than 255 characters.',
        ];
    }
}
