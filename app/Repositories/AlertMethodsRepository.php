<?php

namespace App\Repositories;

use App\Repositories\Eloquent\BaseRepository;
use App\Models\AlertMethod;

class AlertMethodsRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return class
     */
    public function setModel()
    {
        return AlertMethod::class;
    }
}
