<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductVariantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
    
        return [
            'product_id' => 'sometimes|exists:products,id',
            'sku' => 'sometimes|string|unique:product_variants,sku,' . $this->route('product_variant')->id,
            // 'sku' => [
            //     'sometimes',
            //     'string',
            //     Rule::unique('product_variants', 'sku')->ignore($this->route('product_variant')->id),
            // ],
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
        ];
    }
}
