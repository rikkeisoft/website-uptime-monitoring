<?php
namespace App\Repositories;

use Log;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\RepositoryInterface;

class AlertMethodsRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function setModel()
    {
        return 'App\Models\AlertMethod';
    }

    /**
     * @param $user_id
     * @return mixed
     * get all alert method with user_id
     */
    public function findAllAlertMethods($user_id)
    {
        return $this->model->where('user_id', $user_id)
            ->where('deleted_at', null)
            ->get();
    }
}
