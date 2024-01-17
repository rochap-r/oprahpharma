<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyReport extends Mailable
{
    use Queueable, SerializesModels;

    protected $today;


    /**
     * Create a new message instance.
     */
    public function __construct(

        protected $salesRevenue,
        protected $orderCount,
        protected $grossMargin,
        protected $grossMarginPercentage,
        protected $criticalStock,
         $today,
        protected $criticalExpirations,
        protected $salesByusers,
    )
    {
        $this->today=$today;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rapport de vente du '.$this->today,
        );
    }

    /**
     * Get the message content definition.
     */
// Dans app/Mail/DailyReport.php

// Dans app/Mail/DailyReport.php

    public function content()
    {
        return new Content(
            view: 'emails.daily_report',
            with: [
                'salesRevenue' => number_format($this->salesRevenue,0,',',' '),
                'orderCount' => $this->orderCount,
                'grossMargin' => number_format($this->grossMargin,0,',',' '),
                'grossMarginPercentage' => $this->grossMarginPercentage,
                'criticalStock' => $this->criticalStock,
                'today' => $this->today,
                'criticalExpirations' => $this->criticalExpirations,
                'salesByusers' => $this->salesByusers,
            ],
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
