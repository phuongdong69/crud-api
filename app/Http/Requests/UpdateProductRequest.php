<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UPdateProductRequest extends FormRequest
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
            // 'name' => 'sometimes|string|max:255',
            // 'description' => 'sometimes|nullable|string',
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string|max:1000',
            'category_id' => 'sometimes|nullable|exists:categories,id',
            'category_name' => 'sometimes|nullable|string|max:255',

            // Cho phép cập nhật biến thể (nếu có gửi)
            'variants' => 'sometimes|array|min:1',
            'variants.*.sku' => 'required_with:variants|string|max:255',
            'variants.*.price' => 'required_with:variants|numeric|min:0',
            'variants.*.stock' => 'required_with:variants|integer|min:0',

            'variants.*.attribute_values' => 'required_with:variants|array|min:1',
            'variants.*.attribute_values.*.attribute' => 'required|string|max:255',
            'variants.*.attribute_values.*.value' => 'required|string|max:255',
        ];
    }
}
