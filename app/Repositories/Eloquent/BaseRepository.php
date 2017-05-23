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
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract public function setModel();

    /**
     * @return Model
     * make model
     */
    public function makeModel()
    {
        $model = $this->app->make($this->setModel());

        return $this->model = $model;
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * Retrieve all data of repository
     */
    public function all($columns = ['*'])
    {
        return $this->model->all();
    }

    /**
     * @param null $limit
     * @param array $columns
     * @return mixed
     * Retrieve all data of repository, paginated
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? config('repository.pagination.limit', 10) : $limit;

        return $this->model->paginate($limit, $columns);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     * Find data by id
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param array $input
     * @return mixed
     * Save a new entity in repository
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * @param array $input
     * @param $id
     * @return $this
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
     * @param $id
     * @return int
     * Delete a entity in repository by id
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
