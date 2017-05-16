<?php

namespace App/Models;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\UuidModelTrait;

class Website extends Model
{
    use UuidModelTrait;

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'url'
        'name',
        'sensitivity',
        'frequency',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
