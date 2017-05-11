<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{

    protected $fillable = [
        'result','user_id','website_id','alert_group_id',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id','id');
    }

    public function alertgroup()
    {
        return $this->belongsTo(AlertGroup::class, 'alert_group_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
