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
        $id = $this->contractor->id ?? "";

        return [
            'name' => "required|max:100|unique:contractor,name,{$id}",
            'company_name' => "required|max:100|unique:contractor,company_name,{$id}",
            'nip' => "required|max:20|unique:contractor,nip,{$id}",
            'street' => 'required|max:255',
            'locality' => 'required|max:50',
            'post_code' => 'required|max:20',
            'email' => "required|max:100|unique:contractor,email,{$id}"
        ];
    }
}
