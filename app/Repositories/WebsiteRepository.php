<?php
namespace App\Repositories;

use Log;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\RepositoryInterface;

class WebsiteRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function setModel()
    {
        return 'App\Models\Website';
    }

    /**
     * @param $user_id
     * @return mixed
     * get all website with user_id
     */
    public function findAllWebsite($user_id)
    {
        return $this->model->where('user_id', $user_id)
            ->where('deleted_at', null)
            ->get();
    }
}
