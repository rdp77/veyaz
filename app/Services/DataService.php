<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class DataService
{
    /**
     * The model that represents with the service.
     *
     * @var Model
     */
    protected Model $model;

    /**
     * delete permanently all users.
     *
     * @param array $data
     * @param Model $model
     * @return Response
     */
    public function create(array $data, Model $model): Response
    {
        return $model->create($data);
    }

    public function update(array $data, Model $model): bool
    {
        return $model->update(array_filter($data));
    }

    public function deleteTemporarily(Model $model): bool
    {
        return $model->delete();
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function deleteAll(Model $model): bool
    {
        return $model->onlyTrashed()->forceDelete();
    }

    public function restore(Model $model): bool
    {
        return $model->restore();
    }
}
