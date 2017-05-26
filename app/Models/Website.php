<?php
namespace App\Models;

use App\Scopes\UserIdScope;

class Website extends BaseModel
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    const LIST_STATUS = array(
        '1' => 'Enable',
        '2' => 'Disabled',
    );

    const LIST_FREQUENCY = array(
        '5' => '5 minutes',
        '10' => '10 minutes',
        '15' => '15 minutes',
        '20' => '20 minutes',
        '30' => '30 minutes',
        '60' => '60 minutes',
    );

    const LIST_SENSITIVITY = array(
        '1' => 'Low: Retry 1 times',
        '3' => 'Medium: Retry 3 times',
        '5' => 'High: Retry 5 times',
    );

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
