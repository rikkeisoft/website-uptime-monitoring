<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{

    use Notifiable;
    use UuidModelTrait;
    use SoftDeletes;

    public $incrementing = false;
    protected $fillable = [
        'username',
        'email',
        'status',
        'access_token',
        'remember_token',
        'password'
    ];
    protected $hidden = [
        'password'
    ];
}
