<?php

namespace App\Mailer;

use App\Mailer\Mailer;
use App\User;
use Auth;

class UserMailer extends Mailer
{
    public function followNotifyEmail($email)
    {
        $data = ['url' => 'http://zhihu.app','name' => Auth::guard('api')->user()->name];

        $this->sendto('zhihu_app_user_follow',$email,$data);
    }

//    重置密码 发送邮件 5.3自带 未启用
//    public function passwordReset($email,$token)
//    {
//        $data = ['url' => url('password/reset',$token)];
//        $this->sendto('zhihu_app_password_reset',$email,$data);
//    }

    public function welcome(User $user)
    {
        $data = ['url' => route('email.verify',['token' => $user->confirmation_token]),
            'name' => $user->name
        ];
        $this->sendto('zhihu',$user->email,$data);
    }
}