<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert shipping settings if not exists
        $settings = [
            ['shipping_key' => 'weight_coefficient', 'value' => 11.0],
            ['shipping_key' => 'dimension_coefficient', 'value' => 11.0],
        ];

        foreach ($settings as $setting) {
            if (!\App\Models\ShippingSetting::where('shipping_key', $setting['shipping_key'])->exists()) {
                \App\Models\ShippingSetting::create($setting);
            }
        }

        // Insert product type fees if not exists
        $fees = [
            ['type' => 'smartphone', 'fee' => 5.0],
            ['type' => 'diamond_ring', 'fee' => 50.0],
            ['type' => 'default', 'fee' => 10.0],
        ];

        foreach ($fees as $fee) {
            if (!\App\Models\ProductTypeFee::where('type', $fee['type'])->exists()) {
                \App\Models\ProductTypeFee::create($fee);
            }
        }
    }
}
