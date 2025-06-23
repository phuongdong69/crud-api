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
        $category = Category::firstOrCreate(['name' => $data['category_name']]);
        $data['category_id'] = $category->id;
    }

    // Xóa category_name khỏi $data để tránh lỗi khi create Product
    unset($data['category_name']);

    return $this->repository->create($data);
}
public function find($id)
{
    return $this->model->with('category')->findOrFail($id);
}
}