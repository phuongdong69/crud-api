<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductVariantValueRequest;
use App\Http\Requests\UpdateProductVariantValueRequest;
use App\Http\Requests\VariantAttributeValueRequest;
use App\Http\Requests\UpdateVariantAttributeValueRequest;
use App\Http\Resources\ProductVariantValueResource;
use App\Models\ProductVariantValue;

class ProductVariantValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductVariantValueResource::collection(ProductVariantValue::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductVariantValueRequest $request)
    {
        $data = ProductVariantValue::create($request->validated());
        return new ProductVariantValueResource($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductVariantValue $productVariantValue)
    {
        return new ProductVariantValueResource($productVariantValue );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductVariantValueRequest $request, ProductVariantValue $productVariantValue)
    {
        $productVariantValue->update($request->validated());
        return new ProductVariantValueResource($productVariantValue);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductVariantValue $productVariantValue)
    {
         $productVariantValue->delete();
        return response()->json(null, 204);
    }
}
