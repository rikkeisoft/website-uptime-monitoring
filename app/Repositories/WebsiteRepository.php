<?php

namespace App\Repositories;

use App\Repositories\Eloquent\BaseRepository;
use App\Models\Website;

class WebsiteRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return class
     */
    public function setModel()
    {
        return Website::class;
    }
}
