<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{

    protected $fillable = [
        'name', 'sensitivity', 'frequency', 'status', 'url', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
