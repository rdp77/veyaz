<?php

namespace App\Queries;

use App\Entities\User;
use App\ViewModels\UserCollection;
use LaravelCommon\App\Queries\Query;

class UserQuery extends Query
{
    public function identity()
    {
        return User::class;
    }

    public function collectionClass()
    {
        return UserCollection::class;
    }

    /**
     * @param User $user
     * @return self
     */
    public function whereUserNot(User $user): UserQuery
    {
        
        $table = $this->getIdentityTable();
        $this->where($table . '.user_id', '!=', $user->getId());
        return $this;
    }

    public function orWhereName(string $name)
    {
        $table = $this->getIdentityTable();
        $this->orWhere($table . '.name', 'like', '%' . $name . '%');
        return $this;
    }

    public function orWhereEmail(string $email)
    {
        $table = $this->getIdentityTable();
        $this->orWhere($table . '.email', 'like', '%' . $email . '%');
        return $this;
    }
}
