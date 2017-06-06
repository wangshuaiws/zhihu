<?php

namespace App\Repository;

use App\User;

class UserRepository
{
    public function byId($id)
    {
        return User::find($id);
    }
}