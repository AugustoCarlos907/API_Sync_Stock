<?php

namespace App\Listeners;

use App\Events\AlertStockEvent;
use App\Jobs\SendEmailAlertStockJob;
use App\Models\StockItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class AlertStockListener
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
    public function handle(AlertStockEvent $event): void
    {
        SendEmailAlertStockJob::dispatch($event);   
    }
}
