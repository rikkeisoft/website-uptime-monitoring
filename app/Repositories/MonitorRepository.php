<?php
namespace App\Repositories;

use Log;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\RepositoryInterface;

class MonitorRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function setModel()
    {
        return 'App\Models\Monitor';
    }

    /**
     * @param $user_id
     * @return mixed
     * get all monitor
     */
    public function findAllMonitor($user_id)
    {
        return $this->model
            ->where('deleted_at', null)
            ->get();
    }
}
