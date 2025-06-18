<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Định nghĩa route API ở đây
Route::middleware('api')->group(function () {
    Route::apiResource('products', ProductController::class);
});
