<?php

namespace App\ViewModels;

use App\Entities\Scope;
use App\Entities\User;
use App\ViewModels\ScopeViewModel;
use LaravelCommon\ViewModels\AbstractViewModel;
use stdClass;

class UserViewModel extends AbstractViewModel
{
    /**
     * @var bool $autoAddResource;
     */
    protected $isAutoAddResource = true;

    /**
     * @var User $entity
     */
    protected $entity;

    /**
     * @inheritdoc
     */
    public function addResource()
    {
       /**
         * @var Scope $scope
         */
        $scope = $this->entity->getScope();
        if (!empty($scope)) {
            $this->embedResource('scope', new ScopeViewModel($scope, $this->request));
        }
        return $this;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray()
    {
        return [
            'id' => $this->entity->getId(),
            'name' => $this->entity->getName(),
            "username" => $this->entity->getUsername(),
            "email" => $this->entity->getEmail(),
            "email_verified_at" => $this->entity->getEmailVerifiedAt()->format('Y-m-d H:i:s'),
            "password" => $this->entity->getPassword(),
            "two_factor_secret" => $this->entity->getTwoFactorSecret(),
            "two_factor_recovery_codes" => $this->entity->getTwoFactorRecoveryCodes(),
            "two_factor_confirmed_at" => $this->entity->getTwoFactorConfirmedAt(),
            "remember_token" => $this->entity->getRememberToken(),
            "current_team_id" => $this->entity->getCurrentTeamId(),
            "profile_photo_path" => $this->entity->getProfilePhotoPath(),
        ];
    }
}
