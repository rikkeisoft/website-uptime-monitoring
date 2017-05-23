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
     * @return class
     */
    abstract public function setModel();

    /**
     * make model
     * @return Model
     */
    public function makeModel()
    {
        $model = $this->app->make($this->setModel());

        return $this->model = $model;
    }

    /**
     * Retrieve all data of repository
     * @param array $columns
     * @return array
     */
    public function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * Retrieve all data of repository, paginated
     * @param null $limit
     * @param array $columns
     * @return array
     */
    public function paginate(string $limit, $columns = ['*'])
    {
        $limit = is_null($limit) ? 10 : $limit;

        return $this->model->paginate($limit, $columns);
    }

    /**
     * Find data by id
     * @param $id
     * @param array $columns
     * @return array
     */
    public function find(string $id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy(string $attribute, string $value, $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->get($columns);
    }

    /**
     * Save a new entity in repository
     * @param array $input
     * @return boolean
     */
    public function create(array $input)
    {
        return $this->model->create($input);
    }

    /**
     * Update a entity in repository by id
     * @param array $input
     * @param $id
     * @return array
     */
    public function update(array $input, string $id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill($input);
        $model->save();

        return $model;
    }

    /**
     * Delete a entity in repository by id
     * @param $id
     * @return int
     */
    public function delete(string $id)
    {
        return $this->model->destroy($id);
    }
}
