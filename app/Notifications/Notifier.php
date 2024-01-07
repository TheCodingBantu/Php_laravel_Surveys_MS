<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use PhpParser\Node\Expr\Cast\Array_;

class Notifier extends Notification
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $data;


    public function __construct(String $data)
    {
        $this->data = $data;

    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
            // data to be passed as a variable
            // to the view
            'data' => $this->data,
        ];
    }
}
