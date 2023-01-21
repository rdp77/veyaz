<?php

namespace App\ViewModels;

use App\ViewModels\UserViewModel;
use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Interfaces\IEntity;

class UserCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new UserViewModel($entity, $this->request));
    }
}
