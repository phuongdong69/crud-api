<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\BaseRepository2;
use App\Repositories\Contracts\ProductRepositoryInterface2;

class ProductRepository2 extends BaseRepository2
{
    public function __construct()
    {
        // $this->model = app()->make(Product::class);
        parent::__construct(app()->make(Product::class));
    }
//    public function find($id)
//{
//    return $this->model->with('category')->findOrFail($id);
//}
}
