<?php

namespace App\Transformers;

use App\Models\Category;

class CategoryTransformer{
    public function cate(Category $category){
        return [
            'id' => $category->id,
            'name' => $category->name,
        ];
    }
    public function collection($categories){
        return $categories->map(fn($c)=>$this->cate($c));
    }
}