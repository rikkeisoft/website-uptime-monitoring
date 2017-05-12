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

class Alertmethod extends Model
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
