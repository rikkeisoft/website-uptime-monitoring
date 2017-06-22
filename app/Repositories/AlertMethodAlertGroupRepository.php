<?php

namespace App\Repositories;

use App\Contracts\Constants;
use App\Contracts\DatabaseTables;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\AlertMethodAlertGroup;

class AlertMethodAlertGroupRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return class
     */
    public function setModel()
    {
        return AlertMethodAlertGroup::class;
    }

    /**
     * get lisst email alert group.
     *
     * @param string $alertGroupId
     *
     * @return object
     */
    public function getListEmail(string $alertGroupId)
    {
        return $this->model->where('alert_group_id', $alertGroupId)
            ->leftJoin(
                DatabaseTables::ALERT_METHODS,
                DatabaseTables::ALERT_METHOD_ALERT_GROUP . '.alert_method_id',
                '=',
                DatabaseTables::ALERT_METHODS . '.id'
            )
            ->select([
                DatabaseTables::ALERT_METHODS . '.email',
            ])
            ->get();
    }

    /**
     * @param string $userId
     *
     * @return array
     */
    public function getAllAlertMethodAlertGroupByUserId(string $userId)
    {
        return $this->model->whereHas('alertGroup', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->paginate(Constants::DEFAULT_PER_PAGE);
    }
}
