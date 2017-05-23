<?php
namespace App\Repositories;

use App\Repositories\Eloquent\BaseRepository;
use App\Models\AlertGroup;

class AlertGroupsRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function setModel()
    {
        return AlertGroup::class;
    }
}
