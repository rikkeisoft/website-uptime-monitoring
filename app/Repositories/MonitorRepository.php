<?php
namespace App\Repositories;

use App\Repositories\Eloquent\BaseRepository;
use App\Models\Monitor;

class MonitorRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function setModel()
    {
        return Monitor::class;
    }
}
