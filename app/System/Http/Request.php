<?php

namespace App\System\Http;

use App\Entities\MyUser;
use LaravelCommon\System\Http\Request as HttpRequest;

class Request extends HttpRequest
{
    /**
     * Undocumented variable
     *
     * @var ?MyUser
     */
    protected ?MyUser $user = null;

    /**
     * Get User of user
     *
     * @return ?MyUser
     */
    public function getCurrentUser(): ?MyUser
    {
        return $this->user;
    }

    /**
     * Undocumented function
     *
     * @param MyUser $User
     * @return self
     */
    public function setCurrentUser(MyUser $user): Request
    {
        $this->user = $user;
        return $this;
    }
}
