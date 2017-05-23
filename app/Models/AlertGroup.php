<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\UserIdScope;

class AlertGroup extends Model
{
    use UuidModelTrait;
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

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
