<?php

namespace LaravelCommon\App\Repositories;

use App\Entities\User;
use App\ViewModels\UserCollection;
use App\ViewModels\UserViewModel;

class UserRepository extends Repository implements
    UserRepositoryInterface
{
 /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * @inheritDoc
     *
     * @return string
     */
    public function collectionClass(): string
    {
        return UserCollection::class;
    }

    /**
     * @inheritDoc
     *
     * @return stirng
     */
    public function viewModelClass(): string
    {
        return UserViewModel::class;
    }
}
