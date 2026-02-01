<?php

namespace App\Jobs;

use App\Events\AlertStockEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendEmailAlertStockJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public AlertStockEvent $event)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         Mail::to('augustoacarlos@gmail.com', 'Augusto Carlos')
            ->send(new \App\Mail\AlertStockMail($this->event->stockItem));

    }
}
