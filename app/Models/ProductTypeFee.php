<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductTypeFee extends Model
{
    use HasFactory;

    protected $table = 'product_type_fees';

    protected $fillable = [
        'type',
        'fee',
    ];

    protected $casts = [
        'fee' => 'float',
    ];

    public function getFeeAttribute($value)
    {
        return floatval($value);
    }

    public function setFeeAttribute($value)
    {
        $this->attributes['fee'] = floatval($value);
    }
}
