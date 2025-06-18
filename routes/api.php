<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\ProductVariantValueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Models\AttributeValue;

// Định nghĩa route API ở đây
Route::middleware('api')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('attributes', AttributeController::class);
    Route::apiResource('attribute_values', AttributeValueController::class);
    Route::apiResource('product_variants', ProductVariantController::class);
    Route::apiResource('product_variant_values', ProductVariantValueController::class);
});
