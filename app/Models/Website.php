<?php

namespace App;

use App\Contracts\DBTable;
use Illuminate\Database\Eloquent\Model;


class Website extends Model
{
     /**
     * @var string
     */
    protected $table = DBTable::WEBSITE;

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
        'name', 'sensitivity','frequency','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
}
