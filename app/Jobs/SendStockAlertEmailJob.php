<?php

namespace App\Jobs;

use App\Mail\StockLowPriceMail;
use App\Models\StockItem;
use Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendStockAlertEmailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    
    public function __construct( public Collection $items)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $firstItem = $this->items->first();

        if (!$firstItem || !$firstItem->company || !$firstItem->company->user) {
            logger()->warning('Empresa sem utilizador ou email');
            return;
        }

        $user = $firstItem->company->user;

        Mail::to($user->email)
            ->send(new StockLowPriceMail($this->items));
    }

}
