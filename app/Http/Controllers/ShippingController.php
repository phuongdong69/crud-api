<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Shipping\ShippingService;
use App\DTOs\ShippingItemDTO;

class ShippingController extends Controller
{
    protected ShippingService $shippingService;

    public function __construct(ShippingService $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    public function calculate(Request $request)
    {
        // Validate đầu vào
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.amazonPrice' => 'required|numeric',
            'items.*.productWeight' => 'required|numeric',
            'items.*.width' => 'required|numeric',
            'items.*.height' => 'required|numeric',
            'items.*.depth' => 'required|numeric',
            'items.*.type' => 'required|string',
        ]);

        // Convert từng item sang ShippingItemDTO
        $items = collect($validated['items'])
            ->map(fn($item) => new ShippingItemDTO(
                amazonPrice: $item['amazonPrice'],
                productWeight: $item['productWeight'],
                width: $item['width'],
                height: $item['height'],
                depth: $item['depth'],
                type: $item['type'],
            ))
            ->toArray();

        $grossPrice = $this->shippingService->calculateOrderGrossPrice($items);

        return response()->json([
            'gross_price' => $grossPrice,
        ]);
    }
}
