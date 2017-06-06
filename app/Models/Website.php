<?php
namespace App\Models;

use App\Scopes\UserIdScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends BaseModel
{
    use SoftDeletes;

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    const LIST_STATUS = [
        '1' => 'Enable',
        '2' => 'Disabled',
    ];

    const LIST_RESULTS = [
        '1'=>'Success',
        '2'=>'Failed'
    ];

    const LIST_FREQUENCYS = [
        '5' => '5 minutes',
        '10' => '10 minutes',
        '15' => '15 minutes',
        '20' => '20 minutes',
        '30' => '30 minutes',
        '60' => '60 minutes',
    ];

    const LIST_SENSITIVITYS = [
        '1' => 'Low: Retry 1 times',
        '3' => 'Medium: Retry 3 times',
        '5' => 'High: Retry 5 times',
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

    public function monitor()
    {
        return $this->hasMany(Monitor::class, 'website_id', 'id');
    }
}
