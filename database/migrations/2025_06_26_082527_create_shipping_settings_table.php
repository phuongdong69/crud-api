<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipping_settings', function (Blueprint $table) {
            $table->id();
            $table->string('shipping_key')->unique();
            $table->float('value');
            $table->timestamps();
        });

        // Thêm dữ liệu mặc định
        DB::table('shipping_settings')->insert([
            ['shipping_key' => 'weight_coefficient', 'value' => 11.0],
            ['shipping_key' => 'dimension_coefficient', 'value' => 11.0],
            ['shipping_key' => 'smartphone_fee', 'value' => 5.0],
            ['shipping_key' => 'diamond_ring_fee', 'value' => 50.0],
            ['shipping_key' => 'default_fee', 'value' => 10.0],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_settings');
    }
};
