<?php 

namespace App\Services\Shipping;

use App\DTOs\ShippingItemDTO;
class FeeByDimension implements ShippingFeeStrategy
{
    public function __construct(protected float $dimensionCoefficient) {}

    public function calculate(ShippingItemDTO $item): float
    {
        $volume = $item->width * $item->height * $item->depth;
        return $volume * $this->dimensionCoefficient;
    }
    public static function fromConfig(): self
{
    return new self(config('shipping.dimension_coefficient'));
}
}