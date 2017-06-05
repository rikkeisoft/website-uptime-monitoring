<?php

namespace App\Models;

use App\Contracts\DBTable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlertMethodAlertGroup extends BaseModel
{
    use SoftDeletes;

    protected $table = DBTable::ALERT_METHOD_ALERT_GROUP;
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
