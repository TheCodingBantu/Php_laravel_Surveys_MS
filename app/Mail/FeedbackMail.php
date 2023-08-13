<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;
    public $token;
    public $branch;
    public $name;
    public $date;
    public $user_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token,$branch,$name,$date,$user_id)
    {
      $this->token=$token;
      $this->branch=$branch;
      $this->name=$name;
      $this->date=$date;
      $this->user_id=$user_id;

    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->branch . '  Branch Visit Feedback',
            from: new Address('esurvey@gmail.com', 'E-Survey'),
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
            view: 'mail.feedback',

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
