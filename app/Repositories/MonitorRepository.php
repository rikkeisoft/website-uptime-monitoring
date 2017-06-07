<?php
namespace App\Repositories;

use App\Repositories\Eloquent\BaseRepository;
use App\Models\Monitor;

class MonitorRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return class
     */
    public function setModel()
    {
        return Monitor::class;
    }

    public function findByWebsiteId(string $webID)
    {
        return $this->model->where('website_id', $webID)->orderBy('created_at', 'DESC')->first();
    }
}
