<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertMethodlAertGroup extends Model
{

    public function alertgroup()
    {
        return $this->belongsTo(AlertGroup::class, 'alert_group_id','id');
    }

    public function alertmethod()
    {
        return $this->belongsTo(AlertMethod::class, 'alert_method_id','id');
    }
}
