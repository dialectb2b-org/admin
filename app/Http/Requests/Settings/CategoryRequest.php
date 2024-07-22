<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $rule_name_unique = Rule::unique('categories', 'name');
        $rule_code_unique = Rule::unique('categories', 'code');
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rule_name_unique->ignore($this->category->id);
            $rule_code_unique->ignore($this->category->id);
        }
        return [
            'name' => ['required','max:255', $rule_name_unique],
            'code' =>  ['required','max:255', $rule_code_unique],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank.',
            'name.unique' => 'Name is already taken.',
            'name.max' => 'Name must not be greater than 255 characters.',
            'code.required' => 'Code cannot be blank.',
            'code.unique' => 'Code is already taken.',
            'code.max' => 'Code must not be greater than 255 characters.',
        ];
    }
}
