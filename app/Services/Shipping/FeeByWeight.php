<?php

namespace App\Services\Shipping;

use App\DTOs\ShippingItemDTO;
use App\Repositories\ShippingSettingRepository;

class FeeByWeight implements ShippingFeeStrategy
{
    public function __construct(protected float $weightCoefficient) {}

    public function calculate(ShippingItemDTO $item): float
    {
        return $item->productWeight * $this->weightCoefficient;
    }
    public static function fromConfig(): self
    {
        $coefficient = ShippingSettingRepository::get('weight_coefficient');
        return new self($coefficient);
    }
}
