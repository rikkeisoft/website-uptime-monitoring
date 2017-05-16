<?php

namespace App/Models;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\UuidModelTrait;

class AlertMethod extends Model
{
    use UuidModelTrait;

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'email',
        'phone_number',
        'webhook'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
