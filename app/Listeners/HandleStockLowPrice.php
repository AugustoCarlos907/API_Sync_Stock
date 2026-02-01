<?php

namespace App\Listeners;

use App\Events\StockLowPriceDetected;
use App\Jobs\SendStockAlertEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleStockLowPrice
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
    public function handle(StockLowPriceDetected $event): void
    {

    }
}
