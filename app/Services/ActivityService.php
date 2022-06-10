<?php

namespace App\Services;

use App\Models\User;

class ActivityService
{
    public function createUser(array $userData): User
    {
        $user = new User();
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = bcrypt($userData['password']);
        $user->save();

        return $user;
    }
}