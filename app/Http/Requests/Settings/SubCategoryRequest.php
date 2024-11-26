<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCategoryRequest extends FormRequest
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
            'name' =>['required','max:255'],
            'category_id' =>  ['required'],
            'code' => ['required','max:255'],
            'keywords' =>  ['nullable'],
            'status' =>  ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank.',
            'name.max' => 'Name must not be greater than 255 characters.',
            'code.required' => 'Code cannot be blank.',
            'code.max' => 'Code must not be greater than 255 characters.',
        ];
    }
}
