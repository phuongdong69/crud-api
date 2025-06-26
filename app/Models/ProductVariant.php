<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'sku', 'price', 'stock'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function product_variant_values(): HasMany
    {
        return $this->hasMany(ProductVariantValue::class);
    }
}
