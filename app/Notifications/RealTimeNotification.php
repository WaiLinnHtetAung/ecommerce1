<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RealTimeNotification extends Notification
{
    use Queueable;
    public string $message;
    public $orders;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message,$orders)
    {
        $this->message=$message;
        $this->orders=$orders;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    //  public function broadcastAs($notifiable){
    //     return 'App.Models.User.'.$notifiable->id;
    //  }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "user_name"=>$this->orders->user_name,
            "user_email"=>$this->orders->email
        ];
    }
    public function toBroadCast($notifiable){
        $notifications=[
            'user_name'=>$this->orders->user_name,
            'user_email'=>$this->orders->email
        ];
        return new BroadcastMessage([
            'message'=>"$this->message (User $notifiable->id)",
            'notifications'=>$notifications
        ]);
     }
}
