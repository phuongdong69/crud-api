<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use App\Transformers\ProductTransformer;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $transformer;

    public function __construct(ProductService $productService, ProductTransformer $transformer)
    {
        $this->productService = $productService;
        $this->transformer = $transformer;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getAll();
        return response()->json($this->transformer->collection($products));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productService->create($request->validated());
        return response()->json($this->transformer->item($product), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $product = $this->productService->getProductWithVariants($id);
        return response()->json($this->transformer->item($product));
    }
    public function getWithVariants($id)
    {
        return Product::with([
            'category',
            'product_variants.product_variant_values.attribute_value.attribute'
        ])->findOrFail($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, int $id)
    {

        $product = $this->productService->update($id, $request->validated());
        return response()->json($this->transformer->item($product));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->productService->delete($id);
        return response()->json(['message' => 'Product deleted successfully.']);
    }
}
