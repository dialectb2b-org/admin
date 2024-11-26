<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentRequest extends FormRequest
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
            'name' => ['required','max:255'],
            'country_id' =>  ['required'],
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
        ];
    }
}
