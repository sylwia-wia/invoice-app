<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractorRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100|unique:contractor,name',
            'company_name' => 'required|max:100|unique:contractor,company_name',
            'nip' => 'required|max:20|unique:contractor,nip',
            'street' => 'required|max:255',
            'locality' => 'required|max:50',
            'post_code' => 'required|max:20'
        ];
    }
}
