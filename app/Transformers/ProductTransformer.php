<?php

namespace App\Transformers;

use App\Models\Product;

class ProductTransformer
{
    /**
     * Create a new class instance.
     */
    public function item(Product $product)
    {
        
             return [
            "id" => $product->id,
            "category_name" => $product->category->name??null,
            "name" => $product->name,
            "description" => $product->description,
            "variants" => $product->product_variants->map(function($variant) {
            return [
                "id" => $variant->id,
                "name" => $variant->name,
                "attributes" => $variant->product_variant_values->map(function($pvValue) {
                    return [
                        "attribute_name" => $pvValue->attribute_value->attribute->name ?? null,
                        "attribute_value" => $pvValue->attribute_value->value ?? null,
                    ];
                }),
            ];
        }),
            
        ];
    }
    public function collection($products){
        return $products->map(fn($p)=>$this->item($p));
    }
}
