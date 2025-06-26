<?php 

namespace App\Services\Shipping;

use App\DTOs\ShippingItemDTO;

class ShippingCalculator
{
    public function __construct(
        protected array $strategies // mảng các class implement ShippingFeeStrategy
    ) {}

    public function calculateShippingFee(ShippingItemDTO $item): float
    {
        return max(array_map(fn($strategy) => $strategy->calculate($item), $this->strategies));
    }

    public function calculateGrossPrice(ShippingItemDTO $item): float
    {
        return $item->amazonPrice + $this->calculateShippingFee($item);
    }

    public function calculateOrderGrossPrice(array $items): float
    {
        return array_reduce($items, fn($total, $item) =>
            $total + $this->calculateGrossPrice($item), 0);
    }
}
