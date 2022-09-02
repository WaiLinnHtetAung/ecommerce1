<?php

namespace App\Http\Controllers;

use App\Events\FireBaseEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationSendController extends Controller
{
    public function updateDeviceToken(Request $request)
    {
        Auth::user()->device_token = $request->token;
        Auth::user()->save();
        return response()->json(['Token successfully stored']);
    }

    public function sendNotification(Request $request)
    {
      return event(new FireBaseEvent($request->all()));
    }
}
