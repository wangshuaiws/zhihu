<?php

namespace App\Mailer;

use Mail;
use Naux\Mail\SendCloudTemplate;

class Mailer
{
    public function sendto($template,$email,array $data)
    {
        //$data = ['url' => 'http://zhihu.app','name' => Auth::guard('api')->user()->name];
        $content = new SendCloudTemplate($template,$data);

        Mail::raw($content,function ($message) use ($email) {
            $message->from('1473949341@qq.com','小白的小窝');
            $message->to($email);
        });

    }
}