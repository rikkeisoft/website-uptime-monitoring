<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use UuidModelTrait, SoftDeletes;

    public $incrementing = false;
}
