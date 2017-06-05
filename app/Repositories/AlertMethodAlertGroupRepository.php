<?php
namespace App\Repositories;

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
}

