<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function all()
    {
        return Product::all();
    }
    public function find($id){
        return Product::findorFail($id);
    }
    public function create(array $data)
    {
        return Product::create($data);
    }
    public function update($id,array $data){
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }
    public function delete($id){
        $product = $this->find($id);
        return $product->delete();
    }
}
