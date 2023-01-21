<?php

namespace App\ViewModels;

use LaravelCommon\ViewModels\PaggedCollection;
use LaravelOrm\Interfaces\IEntity;

class ScopeCollection extends PaggedCollection
{
    /**
     * @inheritdoc
     */
    public function shape(IEntity $entity)
    {
        $this->addItem(new ScopeViewModel($entity, $this->request));
    }
}
