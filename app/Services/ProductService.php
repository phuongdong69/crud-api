<?php 

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductService
{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    public function getAll()
    {
        return $this->productRepo->all();
        // return Product::with('product_variants')->get();
    }
    public function getByID($id)
    {
        return $this->productRepo->find($id);
    }
    public function create(array $data){
        return $this->productRepo->create($data);
    }
    public function update($id,array $data){
        return $this->productRepo->update($id,$data);
    }
    public function delete($id){
        return $this->productRepo->delete($id);
    }
    public function getProductWithVariants($id)
    {
        return $this->productRepo->getWithVariants($id);
    }
}