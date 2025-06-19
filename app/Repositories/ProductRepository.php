<?php

namespace App\Repositories;

use App\Models\Product;


class ProductRepository extends BaseRepository implements ProductRepositoryInterface{
    public function __construct(Product $product){
        $this->model = $product;    
    }
}