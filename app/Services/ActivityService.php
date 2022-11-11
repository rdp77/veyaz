<?php

namespace App\Services;

use App\Models\User;

class ActivityService
{
    /**
     * The model that represents with the service.
     *
     * @var App\Models\User
     */
    protected User $user;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * delete permanently all users.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  \App\Services\UserService  $userService
     * @return \Illuminate\Http\Response
     */
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
