<?php

use App\Contracts\DBTable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    /**
     * @var string
     */
    protected $table = DBTable::USER;

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
        'username', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
