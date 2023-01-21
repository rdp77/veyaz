<?php

namespace App\Queries;

use App\Entities\MyUser;
use App\ViewModels\UserCollection;
use LaravelCommon\App\Queries\Query;

class UserQuery extends Query
{
    public function identity()
    {
        return MyUser::class;
    }

    public function collectionClass()
    {
        return UserCollection::class;
    }

    /**
     * @param MyUser $user
     * @return self
     */
    public function whereUserNot(MyUser $user): UserQuery
    {
        
        $table = $this->getIdentityTable();
        $this->where($table . '.user_id', '!=', $user->getId());
        return $this;
    }

    public function whereIsDelete(bool $deleted = true) 
    {
        $table = $this->getIdentityTable();
        $this->where($table . '.is_deleted', '=', $deleted);
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
