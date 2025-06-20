<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface{
    public function __construct(Category $category){
        $this->model = $category;
    }
    public function getByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }
}