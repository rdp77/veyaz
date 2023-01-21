<?php

namespace App\System\Http;

use App\Entities\User;
use LaravelCommon\System\Http\Request as HttpRequest;

class Request extends HttpRequest
{
    /**
     * Undocumented variable
     *
     * @var ?User
     */
    protected ?User $user = null;

    /**
     * Get User of user
     *
     * @return ?User
     */
    public function getCurrentUser(): ?User
    {
        return $this->user;
    }

    /**
     * Undocumented function
     *
     * @param User $User
     * @return self
     */
    public function setCurrentUser(User $user): Request
    {
        $this->user = $user;
        return $this;
    }
}
