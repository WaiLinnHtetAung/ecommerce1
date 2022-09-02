<?php

namespace App\Listeners;

use App\Events\FireBaseEvent;
use App\Models\User;
use App\Notifications\FireBaseNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class FireBaseListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\FireBaseEvent  $event
     * @return void
     */
    public function handle(FireBaseEvent $event)
    {
        $data=$event->data;
        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $serverKey = 'AAAAQsTLzio:APA91bGX15uGiJP2QXUcixeNNqJzBCrYuiRPhyOf6ocLlM38Kb8WjEqR8hTU-BjXfBv4Swaib84-emaBGQ_lfgtAcaMUqfXyVIjcnw0QmSRN9RQndY4QK7PODiOKIusTfYkdVIfd4A9e';

        $result = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $data['title'],
                "body" => $data['body'],
            ]
        ];
        $encodedData = json_encode($result);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        $admin = User::find(1);
        Notification::send($admin, new FireBaseNotification($data));
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
        return response()->json(["message"=>"send successfully "]);
    }
}
