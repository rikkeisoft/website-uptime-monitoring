<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\UserIdScope;

class AlertGroup extends BaseModel
{
    use SoftDeletes;

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserIdScope());
    }

    protected $fillable = [
        'user_id',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
