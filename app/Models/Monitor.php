<?php
namespace App;

use App\Contracts\DBTable;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{

    /**
     * @var string
     */
    protected $table = DBTable::MONITOR;

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'result'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alertgroup()
    {
        return $this->belongsTo(Alertgroup::class, 'alert_group_id', 'id');
    }
}
