<?php

namespace App\Services;

class BaseService
{
	protected $model;

    function create($request)
    {
    	return $this->model->firstOrCreate($request->all());
    }

    function update(int $id, $request)
    {
        return $this->model->where('id', $id)->update($request->all());
    }

    function delete(int $id)
    {
        return $this->model->delete($id);
    }

    function select($request)
    {
        return $this->model->get();
    }

}