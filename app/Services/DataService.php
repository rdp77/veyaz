<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

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
    public function create(array $data, Model $model): JsonResponse
    {
        $newId = $model->create($data);
        // return Response::json([
        //     'status' => 'success',
        //     'data' => 'Berhasil membuat pengguna baru',
        // ]);
        return response()->json(['id' => $newId->id], 201);
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
