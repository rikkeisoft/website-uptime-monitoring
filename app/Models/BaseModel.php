<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\UuidModelTrait;

class BaseModel extends Model
{
    use UuidModelTrait;

    public $incrementing = false;
}
