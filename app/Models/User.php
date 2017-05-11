<?php

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = [
        'username', 'email', 'password'
    ];
    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
