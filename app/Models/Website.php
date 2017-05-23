<?php
namespace App\Models;

use App\Models\BaseModelInterface;
use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Website extends Model
{
    use UuidModelTrait;
    use SoftDeletes;

    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'url',
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
