<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class OrderStatusMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $status;
    public $order_number;
    public $order_date;
    public $totals;
    public $track_link;
    public $desc;

    public function __construct($name,$status,$desc,$order_number,$order_date,$totals,$track_link)
    {
        $this->name =$name;
        $this->desc = $desc;
        $this->status = $status;
        $this->order_number = $order_number;
        $this->order_date = $order_date;
        $this->totals = $totals;
        $this->track_link = $track_link;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */

    public function envelope()
    {

        return new Envelope(
            subject: 'Order Status Mail',
            from: new Address('esurvey@gmail.com', 'Macho Poa'),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.order-status',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
