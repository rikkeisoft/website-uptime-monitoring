<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertMethod extends Model
{

    protected $fillable = [
        'name', 'type', 'email', 'phone_number', 'webhook','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
