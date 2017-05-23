<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    /**
     * Retrieve all data of repository
     */
    public function all();

    /**
     * Find data by id
     */
    public function find($id, $columns = ['*']);

    public function paginate($limit = null, $columns = ['*']);
    /**
     * Save a new entity in repository
     */
    public function create(array $input);

    public function update(array $input, $id);

    public function delete($id);

}