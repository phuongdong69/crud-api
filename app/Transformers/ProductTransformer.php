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
            "id"=> $product->id,
            "category_id"=> $product->category_id,
            "name"=> $product->name,
            "description"=> $product->description,
        ];
    }
    public function collection($products){
        return $products->map(fn($p)=>$this->item($p));
    }
}
