<?php
namespace App\Repositories;

use App\Repositories\Eloquent\BaseRepository;
use App\Models\AlertGroup;
use Yajra\Datatables\Datatables;

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

    public function searchAlertGroup($alertGroups)
    {
        $alertGroups = AlertGroup::select(['id', 'name','created_at', 'updated_at']);
        return $alertGroups;

    }
}
