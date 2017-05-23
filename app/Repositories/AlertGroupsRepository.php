<?php
namespace App\Repositories;

use Log;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\RepositoryInterface;

class AlertGroupsRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function setModel()
    {
        return 'App\Models\AlertGroup';
    }

    /**
     * @param $user_id
     * @return mixed
     * get all alert group with user_id
     */
    public function findAllAlertGroups($user_id)
    {
        return $this->model->where('user_id', $user_id)
            ->where('deleted_at', null)
            ->get();
    }
}
