<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    /**
     * Retrieve all data of repository
     */
    public function all($columns = ['*']);

    /**
     * Find data by id
     */
    public function find($id, $columns = ['*']);

    /**
     * @param null $limit
     * @param array $columns
     * @return mixed
     *  Retrieve all data of repository, paginated
     */
    public function paginate($limit = null, $columns = ['*']);

    /**
     * @param array $input
     * @return mixed
     * Save a new entity in repository
     */
    public function create(array $input);

    /**
     * @param array $input
     * @param $id
     * @return mixed
     * Update a entity in repository by id
     */
    public function update(array $input, $id);

    /**
     * @param $id
     * @return mixed
     * Delete a entity in repository by id
     */
    public function delete($id);
}
