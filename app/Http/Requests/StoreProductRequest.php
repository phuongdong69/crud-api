<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category_id'   => 'required_without:category_name|nullable|exists:categories,id',
            'category_name' => 'required_without:category_id|nullable|string|max:255',

            // Biến thể sản phẩm
            'variants' => 'nullable|array',
            'variants.*' => 'array',
            'variants.*.sku' => 'required|string|max:255',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',

            // Thuộc tính của biến thể
            'variants.*.attribute_values' => 'required|array|min:1',
            'variants.*.attribute_values.*.attribute' => 'required|string|max:255',
            'variants.*.attribute_values.*.value' => 'required|string|max:255',
        ];
    }
}
