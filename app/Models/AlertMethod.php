<?php

namespace App\Models;

use App\Scopes\UserIdScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlertMethod extends BaseModel
{
    use SoftDeletes;
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
