<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    /**
     * Retrieve all data of repository
     * @param array $columns
     * @return array
     */
    public function all(array $columns = ['*']);

    /**
     * Find data by id
     * @param string $id
     * @param array $columns
     * @return array
     */
    public function find(string $id, $columns = ['*']);

    /**
     * find data by attribute
     * @param string $attribute
     * @param string $value
     * @param array $columns
     * @return mixed
     */
    public function findAllBy(string $attribute, string $value, $columns = ['*']);

    /**
     * Retrieve all data of repository, paginated
     * @param string $limit
     * @param array $columns
     * @return array
     */
    public function paginate(string $limit, $columns = ['*']);

    /**
     * Save a new entity in repository
     * @param array $input
     * @return boolean
     */
    public function create(array $input);

    /**
     * Update a entity in repository by id
     * @param array $input
     * @param string $id
     * @return array
     */
    public function update(array $input, string $id);

    /**
     * Delete a entity in repository by id
     * @param string $id
     * @return int
     */
    public function delete(string $id);
}
