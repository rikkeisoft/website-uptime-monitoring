<?php
namespace App\Repositories;

use App\Repositories\Eloquent\BaseRepository;
use App\Models\AlertGroup;

class AlertGroupsRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return class
     */
    public function setModel()
    {
        return AlertGroup::class;
    }

    /**
     * @param $alertGroups
     * @return mixed
     */
    public function searchAlertGroup($alertGroups)
    {
        $alertGroups = AlertGroup::select(['id', 'name','created_at', 'updated_at']);
        return $alertGroups;
    }
}
