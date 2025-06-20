<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "name",
    ];
    public function product(Product $product)
    {
        return $this->hasMany(Product::class);
    }
    public function getByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }
}
