<?php

namespace App\Models;

class AlertMethodAlertGroup extends BaseModel
{
    protected $table ='alert_method_alert_group';
    protected $fillable = [
        'alert_method_id',
        'alert_group_id'
    ];
    public function alertGroup()
    {
        return $this->belongsTo(AlertGroup::class, 'alert_group_id', 'id');
    }

    public function alertMethod()
    {
        return $this->belongsTo(AlertMethod::class, 'alert_method_id', 'id');
    }
}
