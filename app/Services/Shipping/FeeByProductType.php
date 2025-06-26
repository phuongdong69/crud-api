<?php  
namespace App\Services\Shipping;    

use App\DTOs\ShippingItemDTO;
class FeeByProductType implements ShippingFeeStrategy
{
    public function calculate(ShippingItemDTO $item): float
    {
        return match ($item->type) {
            'smartphone' => 5.0,
            'diamond_ring' => 50.0,
            default => 10.0,
        };
    }
}