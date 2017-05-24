<?php

namespace App\Models;

class Monitor extends BaseModel
{
    protected $fillable = [
        'result',
        'website_id',
        'alert_group_id',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id', 'id');
    }

    public function alertGroup()
    {
        return $this->belongsTo(AlertGroup::class, 'alert_group_id', 'id');
    }
}
