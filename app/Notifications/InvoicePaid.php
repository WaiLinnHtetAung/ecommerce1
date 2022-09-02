<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Smspoh\SmspohMessage;


class InvoicePaid extends Notification
{
    use Queueable;

    public $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message=$message;
    }

    public function via($notifiable)
    {
        return ['smspoh'];
    }
    public function toSmspoh($notifiable)
    {
        return (new SmspohMessage)->content($this->message)->sender('Smspoh');       
    }
}
