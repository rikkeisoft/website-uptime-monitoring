<?php

namespace App;
use App\Contracts\DBTable;
use Illuminate\Database\Eloquent\Model;
class AlertMethod extends Model
{
      /**
     * @var string
     */
    protected $table = DBTable::ALERTGROUP;

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
        'name','type','email','phone_number','webhook'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
