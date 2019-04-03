<?php

namespace App\Http\Repositories;

abstract class Repository
{
	protected $modelClassName;

	public function create(array $attributes)
	{
		return $this->modelClassName::create($attributes);
	}

	public function firstOrCreate(array $attributes)
	{
		return $this->modelClassName::firstOrCreate($attributes);
	}

	public function all($columns = array('*'))
	{
		return $this->modelClassName::all($columns);
	}

	public function orderBy($columns = array('*'))
	{
		return $this->modelClassName::orderBy($columns);
	}

	public function find($id, $columns = array('*'))
	{
		return $this->modelClassName::find($id, $columns);
	}

	public function where($columns)
	{
		return $this->modelClassName::where($columns);
	}

	public function delete($id)
	{
		return $this->modelClassName::destroy($id);
	}

	/**
	 * Updates a model single column
	 * @param  Model $model   inherits from Eloquent Model
	 * @param  Request $request A Request object
	 * @param  string $column  String name of the property on the Databse Table
	 * it should be the same you get in the request
	 * @return void
	 */
	public function updateColumn($model, $request, $column)
	{
		$property = $column;
		$model->$property = $request->input($column);
		$model->save();
	}	

	public function update($columns, $model)
	{

		$model->fill($columns);
		$model->save();
	}
}