<?php

namespace App\Models;

use App\Scopes\UserIdScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlertMethod extends BaseModel
{
    use SoftDeletes;

    const LIST_TYPE_ALERT_METHOD = [
        '1' => 'Email',
        '2' => 'SMS',
        '3' => 'Webhook'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserIdScope());
    }
    
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'email',
        'phone_number',
        'webhook'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function alertmethodalertgroup()
    {
        return $this->hasOne(AlertMethodAlertGroup::class);
    }
}
