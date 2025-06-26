<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Eloquent\ProductRepository2;

class ProductService2 extends BaseService
{
    public function __construct(ProductRepository2 $productRepo)
    {
        $this->repository = $productRepo;
    }
    public function create(array $data)
    {
        // Nếu có truyền category_name mà không có category_id
        if (!empty($data['category_name']) && empty($data['category_id'])) {
            // Tìm hoặc tạo mới category theo tên
            $data['category_id'] = Category::firstOrCreate(['name' => $data['category_name']])->id;
        }

        // Xóa category_name khỏi $data để tránh lỗi khi create Product
        unset($data['category_name']);

        // Tạo sản phẩm
        $product = $this->repository->create($data);
        
        // 
        // Xử lý tạo mới variant và attribute nếu chưa có
        // foreach ($variants as $variantData) {
        //     // Tạo mới hoặc lấy variant
        //     $variant = $product->product_variants()->firstOrCreate(['name' => $variantData['name']]);

        //     foreach ($variantData['values'] as $valueData) {
        //         // Tạo mới hoặc lấy attribute
        //         $attribute = \App\Models\Attribute::firstOrCreate(['name' => $valueData['attribute']]);
        //         // Tạo mới hoặc lấy attribute_value
        //         $attributeValue = \App\Models\AttributeValue::firstOrCreate([
        //             'attribute_id' => $attribute->id,
        //             'value' => $valueData['value']
        //         ]);
        //         // Gắn giá trị vào variant
        //         $variant->product_variant_values()->firstOrCreate([
        //             'attribute_value_id' => $attributeValue->id
        //         ]);
        //     }
        // }
        if (isset($data['variants'])) {
            foreach ($data['variants'] as $variantData) {
                $variant = $product->product_variants()->firstOrCreate(['sku' => $variantData['sku']]);
                
                foreach ($variantData['attribute_values'] as $valueData) {
                    $attribute = \App\Models\Attribute::firstOrCreate(['name' => $valueData['attribute']]);
                    $attributeValue = \App\Models\AttributeValue::firstOrCreate([
                        'attribute_id' => $attribute->id,
                        'value' => $valueData['value']
                    ]);
                    $variant->product_variant_values()->firstOrCreate([
                        'attribute_value_id' => $attributeValue->id
                    ]);
                }
            }

        // Trả về sản phẩm đã load các quan hệ
        return $this->repository->find($product->id, ['relations' => ['category']]);
    }
}}
