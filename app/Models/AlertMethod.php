<?php

namespace App\Models;

use App\Models\BaseModelInterface;
use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlertMethod extends BaseModelInterface
{
    use UuidModelTrait;
    use SoftDeletes;

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
