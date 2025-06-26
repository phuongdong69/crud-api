<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipping_key',
        'value',
    ];

    protected $casts = [
        'value' => 'float',
    ];

    public function getValueAttribute($value)
    {
        return floatval($value);
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = floatval($value);
    }
}
