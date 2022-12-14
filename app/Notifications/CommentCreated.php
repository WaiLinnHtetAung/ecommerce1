<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentCreated extends Notification
{
    use Queueable;
     public $user;
     public $comment_id;
     public $comment_status;
     public $comment;
     public $product_name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$comment_id,$comment_status,$comment,$product_title)
    {
        $this->user =$user;
        $this->comment_id =$comment_id;
        $this->comment_status=$comment_status;
        $this->comment=$comment;
        $this->product_name=$product_title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user_id' =>$this->user->id,
            'user_name'=>$this->user->name,
            'comment_id'=>$this->comment->id,
            'comment_status'=>$this->comment->status,
            'comment'=>$this->comment,
            'product_name'=>$this->product_name
        ];
    }
}
