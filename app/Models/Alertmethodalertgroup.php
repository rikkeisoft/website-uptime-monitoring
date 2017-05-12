<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alertmethodalertgroup extends Model
{
   /**
     * @var string
     */
    protected $table = DBTable::ALERTMETHODALERTGROUP;

    /**
     * @var string
     */
    protected $primaryKey = 'id';


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alertgroup()
    {
        return $this->belongsTo(Alertgroup::class, 'alert_group_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alertmethod()
    {
        return $this->belongsTo(Alertmethod::class, 'alert_method_id', 'id');
    }
}
