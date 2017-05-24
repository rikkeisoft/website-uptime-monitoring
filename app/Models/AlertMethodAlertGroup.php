<?php

namespace App\Models;

use App\Models\BaseModel;

class AlertMethodAlertGroup extends BaseModel
{
    public function alertGroup()
    {
        return $this->belongsTo(AlertGroup::class, 'alert_group_id', 'id');
    }

    public function alertMethod()
    {
        return $this->belongsTo(AlertMethod::class, 'alert_method_id', 'id');
    }
}
