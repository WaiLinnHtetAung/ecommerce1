<?php

namespace App\Listeners;

use App\Events\UserNotification;
use App\Models\User;
use App\Notifications\UserNotification as NotificationsUserNotification;
use App\Notifications\UserRegisterNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class SendUserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function handle($event)
    {
        $admin=User::find(1);
        Notification::send($admin,new NotificationsUserNotification($event->user));
    }
}
