<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PreRegistrationRequest extends FormRequest
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
            'email' =>  ['required','max:255'],
            'alt_email_1' => ['nullable','max:255'],
            'alt_email_2' => ['nullable','max:255'],
            'country_id' =>  ['required'],
            'temp_categories' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank.',
            'name.max' => 'Name must not be greater than 255 characters.',
            'email.required' => 'Email cannot be blank.',
            'email.max' => 'Email must not be greater than 255 characters.',
            'alt_email_1.max' => 'Email must not be greater than 255 characters.',
            'alt_email_2.max' => 'Email must not be greater than 255 characters.',
            'country_id.required' => 'Please choose country.',
        ];
    }
}
