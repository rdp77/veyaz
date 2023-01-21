<?php

namespace App\Http\Middleware\Hydrators;

use App\Repositories\ScopeRepository;
use LaravelCommon\App\Http\Middleware\Hydrator;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use LaravelCommon\System\Http\Request;

class UserHydrator extends Hydrator
{
    public const NAME = 'app.middelware.hydrator.user';


    /**
     * @var ScopeRepository
     */
    protected ScopeRepository $scopeRepository;

    /**
     *
     * @param scopeRepository $scopeRepository
     */
    public function __construct(
        ScopeRepository $scopeRepository
    ) {
        $this->scopeRepository = $scopeRepository;
    }

    /**
     *
     * @return string
     */
    public function repositoryClass(): string
    {
        return UserRepository::class;
    }

    public function afterHydrate(Request $request)
    {
        if(strtoupper($request->getMethod() == 'POST')) {
            if(isset($request->password)) {
                $this->resource->setPassword(Hash::make($request->password));
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function getKey(): string
    {
        return 'user';
    }

    /**
     * @inheritDoc
     */
    protected function hydrateObjects()
    {
        return [
            'scope_id' => [
                [$this->resource, 'setScope'],
                [$this->scopeRepository, 'find']
            ]
        ];
    }
}
