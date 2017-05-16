<?php

namespace App/Models;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\UuidModelTrait;

class User extends Model
{
    use UuidModelTrait;

    public $incrementing = false;

    protected $fillable = [
        'username',
        'email',
        'password_hash'
    ];

    protected $hidden = [
        'password_hash',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password_hash'] = Hash::make($value);
    }
}
