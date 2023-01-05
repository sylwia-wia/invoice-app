<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BusinessDocumentRequest extends FormRequest
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
            'document.document_type_id' => ['required', Rule::exists('document_type', 'id')],
            'document.contractor_id' => ['required', Rule::exists('contractor', 'id')],
            'document.number' => 'required',
            'document.issue_date' => 'required',
            'document.sale_date' => 'required',
            'document.payment_date' => 'required',
            'position.*.product_id' => ['required', Rule::exists('product', 'id')],
            'position.*.unit_id' => ['required', Rule::exists('unit', 'id')],
            'position.*.net_price' => 'required',
            'position.*.quantity' => 'required',
            'position.*.vat_rate_id' => ['required', Rule::exists('vat_rate', 'id')],
            'position.*.vat_value' => 'required',
            'position.*.gross_value' => 'required',
        ];
    }
}
