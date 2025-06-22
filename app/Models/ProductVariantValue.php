<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariantValue extends Model
{
   protected $fillable = ['product_variant_id', 'attribute_value_id'];

    public function product_variants(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

   

    public function attribute_value(): BelongsTo
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
