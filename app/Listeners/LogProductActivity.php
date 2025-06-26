<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Events\ProductUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogProductActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        // $action = $event instanceof ProductCreated ? 'created' : 'updated';
        // Log::info("Product {$action}: ID = " . $event->product->id . ', Name = ' . $event->product->name);
        if ($event instanceof ProductCreated) {
            Log::info("🟢 Product created: ID={$event->product->id}, Name={$event->product->name}");
        }

        if ($event instanceof ProductUpdated) {
            Log::info("🟡 Product updated: ID={$event->product->id}, Name={$event->product->name}");
        }
    }
}
