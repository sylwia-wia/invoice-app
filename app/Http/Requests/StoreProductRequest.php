<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed $product
 */
class StoreProductRequest extends FormRequest
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
        $id = $this->product->id ?? "";

        return [
            'name' => "required|max:100|unique:product,name,{$id}",
            'unit_id' => 'required|max:30|exists:unit,id',
            'vat_rate_id' => 'required|integer|exists:vat_rate,id',
            'price' => 'required|numeric|gt:0|lt:99999999'
        ];
    }

}
