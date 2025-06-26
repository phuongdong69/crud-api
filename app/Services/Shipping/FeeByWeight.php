<?php

namespace App\Services\Shipping;

use App\DTOs\ShippingItemDTO;


class FeeByWeight implements ShippingFeeStrategy
{
    public function __construct(protected float $weightCoefficient) {}

    public function calculate(ShippingItemDTO $item): float
    {
        return $item->productWeight * $this->weightCoefficient;
    }
    public static function fromConfig(): self
    {
        return new self(config('shipping.weight_coefficient'));
    }
}
