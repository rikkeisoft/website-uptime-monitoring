<?php
namespace App\Repositories;

use App\Contracts\Constants;
use App\Contracts\DBTable;
use App\Repositories\Eloquent\BaseRepository;
use App\Models\AlertMethodAlertGroup;

class AlertMethodAlertGroupRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return class
     */
    public function setModel()
    {
        return AlertMethodAlertGroup::class;
    }
    /**
     * get lisst email alert group
     * @param string $alertGroupId
     * @return object
     */
    public function getListEmail(string $alertGroupId)
    {
        return $this->model->where('alert_group_id', $alertGroupId)
            ->leftJoin(
                DBTable::ALERT_METHOD,
                DBTable::ALERT_METHOD_ALERT_GROUP.'.alert_method_id',
                '=',
                DBTable::ALERT_METHOD.'.id'
            )
            ->select([
                DBTable::ALERT_METHOD.'.email',
            ])
            ->get();
    }

    /**
     * @param string $user_id
     * @return array
     */
    public function getAllAlertMethodAlertGroupByUserId($user_id)
    {
        return $this->model->whereHas('alertGroup', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
        })->paginate(Constants::LIMIT_PAGINATE);
    }
}
