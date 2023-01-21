<?php

namespace App\Repositories;

use App\Entities\MyScope;
use App\Entities\MyUser;
use App\ViewModels\UserCollection;
use App\ViewModels\UserViewModel;
use LaravelCommon\App\Repositories\Repository;

class ScopeRepository extends Repository implements
    ScopeRepositoryInterface
{
 /**
    * Constrcutor
    */
    public function __construct()
    {
        parent::__construct(MyScope::class);
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
