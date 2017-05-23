<?php
namespace App\Repositories;

use App\Repositories\Eloquent\BaseRepository;
use App\Models\Website;

class WebsiteRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function setModel()
    {
        return Website::class;
    }
}
