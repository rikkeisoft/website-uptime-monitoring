<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Scopes\UserIdScope;

class AlertMethod extends BaseModel
{
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
}
