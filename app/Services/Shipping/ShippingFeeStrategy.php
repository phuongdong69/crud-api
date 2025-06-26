<?php
namespace App\Services\Shipping;

use App\DTOs\ShippingItemDTO;

interface ShippingFeeStrategy
{
    public function calculate(ShippingItemDTO $item): float;
}