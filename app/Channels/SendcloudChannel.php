<?php

namespace App\Channels;
use Illuminate\Notifications\Notification;

class SendcloudChannel
{
    public function send($notifiable,Notification $notification)
    {
        $messages = $notification->toSendcloud($notifiable);
    }
}