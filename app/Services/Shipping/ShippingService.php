<?php

namespace App\Services\Shipping;

use App\DTOs\ShippingItemDTO;

class ShippingService
{
    protected ShippingCalculator $calculator;

    public function __construct()
    {
        $strategies = [
            FeeByWeight::fromConfig(),
            FeeByDimension::fromConfig(),
            new FeeByProductType(), // tự đọc config bên trong
        ];

        $this->calculator = new ShippingCalculator($strategies);
    }

    public function calculateShippingFee(ShippingItemDTO $item): float
    {
        return $this->calculator->calculateShippingFee($item);
    }

    public function calculateGrossPrice(ShippingItemDTO $item): float
    {
        return $this->calculator->calculateGrossPrice($item);
    }

    /**
     * @param ShippingItemDTO[] $items
     */
    public function calculateOrderGrossPrice(array $items): float
    {
        return $this->calculator->calculateOrderGrossPrice($items);
    }
}
