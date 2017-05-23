<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Monitor extends Model
{
    use UuidModelTrait;
    use SoftDeletes;

    public $incrementing = false;

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
