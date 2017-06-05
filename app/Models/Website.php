<?php
namespace App\Models;

use App\Scopes\UserIdScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends BaseModel
{
    use SoftDeletes;

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
  
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
        'url',
        'name',
        'sensitivity',
        'frequency',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
