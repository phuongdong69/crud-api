<?php 
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProductTypeFeeRepository
{
    public static function getFee(string $type): float
    {
        return DB::table('product_type_fees')
            ->where('type', $type)
            ->value('fee')
            ?? DB::table('product_type_fees')->where('type', 'default')->value('fee') ?? 0;
    }
}
