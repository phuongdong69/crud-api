<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id'   => 'required_without:category_name|nullable|exists:categories,id',
            'category_name' => 'required_without:category_id|nullable|string',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'brand'         => 'nullable|string',
            'price'         => 'nullable|numeric',
            'status'        => 'nullable|string',
        ];
    }
}
