<?php

namespace App;

use App\Contracts\DBTable;
use App\Notifications\UserWasRegistered as RegisteredNotification;
use App\Notifications\PasswordWillReset as PasswordResetNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


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
