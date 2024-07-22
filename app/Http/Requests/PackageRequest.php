<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PackageRequest extends FormRequest
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
            'name' => ['required'],
            'rate' => ['required'],
            'duration' => ['required'],
            'sales_enquiry_receive_limit' => ['required'],
            'sales_respond_enquiry_limit' => ['required'],
            'sales_limited_enquiry_participation_limit' => ['required'],
            'sales_faq_option' => ['required'],
            'sales_inbox_validity' => ['required'],
            'procurement_enquiry_receive_limit' => ['required'],
            'procurement_proposal_receiving_limit' => ['required'],
            'procurement_member_apprroval_limit' => ['required'],
            'procurement_limited_enquiry_limit' => ['required'],
            'procurement_review_quote_limit' =>	['required'],
            'procurement_inbox_validity' =>	['required'],
            'member_enquiry_limit' => ['required'],	
            'member_proposal_receive_limit' =>	['required'],
            'member_limited_enquiry_limit' =>	['required'],
            'member_review_quote_limit' =>	['required'],
            'member_inbox_validity' => ['required'],
        ];
    }
}


	