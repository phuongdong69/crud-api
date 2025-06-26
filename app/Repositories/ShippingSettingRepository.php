<?php 
namespace App\Repositories;

use Illuminate\Support\Facades\Cache;
use App\Models\ShippingSetting;
use App\Models\ProductTypeFee;

class ShippingSettingRepository
{
    public static function get(string $key, float $default = 0.0): float
    {
        return Cache::remember('shipping_setting_' . $key, 60, function () use ($key, $default) {
            $setting = ShippingSetting::where('shipping_key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function getAllTypeFees()
    {
        return Cache::remember('shipping_type_fees', 60, function () {
            $fees = ProductTypeFee::all()
                ->mapWithKeys(function ($item) {
                    return [$item->type => $item->fee];
                })
                ->toArray();
        
            // Thêm default fee
            $defaultFee = ProductTypeFee::where('type', 'default')->first();
            if ($defaultFee) {
                $fees['default'] = $defaultFee->fee;
            }
        
            return $fees;
        });
    }
}
