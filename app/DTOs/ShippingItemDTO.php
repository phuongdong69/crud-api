<?php
namespace App\DTOs;
class ShippingItemDTO
{
    public function __construct(
        public float $amazonPrice,
        public float $productWeight,
        public float $width,
        public float $height,
        public float $depth,
        public string $type
    ) {}
}
