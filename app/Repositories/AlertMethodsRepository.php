<?php
namespace App\Repositories;

use App\Repositories\Eloquent\BaseRepository;
use App\Models\AlertMethod;
use App\Contracts\DBTable;

class AlertMethodsRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return class
     */
    public function setModel()
    {
        return AlertMethod::class;
    }

    /**
     * @param $alertMethods
     * @return mixed
     */
    public function searchAlertMethod($alertMethods)
    {
        $alertMethods = AlertMethod::with('alertMethodAlertGroup')->select('alert_methods.*')->get();
        return $alertMethods;
    }
}
