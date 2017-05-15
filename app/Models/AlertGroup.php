<?php
namespace App;

use App\Contracts\DBTable;
use Illuminate\Database\Eloquent\Model;

class AlertGroup extends Model
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
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
}
