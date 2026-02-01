<?php

namespace App\Mail;

use App\Models\StockItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AlertStockMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public StockItem $stockItem)
    {}

   
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Alert Stock Mail',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'emails.alert_stock',
        );
    }


    public function attachments(): array
    {
        return [];
    }
}
