<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttributeValue extends Model
{
    protected $fillable = ['attribute_id', 'value'];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
    public function product_variant_values(): HasMany
    {
        return $this->hasMany(ProductVariantValue::class);
    }
}
