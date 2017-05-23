<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{

    /**
     * @var App
     */
    private $app;

    /**
    var
     */
    protected $model;

    /**
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel() {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }

    /**
     * Retrieve all data of repository
     */
    public function all($columns = ['*'])
    {
        return $this->model->all();
    }

    /**
     * Retrieve all data of repository, paginated
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 10) : $limit;

        return $this->model->paginate($limit, $columns);
    }
    /**
     * Find data by id
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Save a new entity in repository
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Update a entity in repository by id
     */
    public function update(array $input, $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($input);
        $model->save();

        return $this;
    }

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}