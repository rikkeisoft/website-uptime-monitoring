<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Alsofronie\Uuid\UuidModelTrait;
use Illuminate\Support\Str;

class User extends Model
{

    use UuidModelTrait;

    public $incrementing = false;
    protected $fillable = [
        'username',
        'email',
        'password_hash',
        'status'
    ];
    protected $hidden = [
        'password_hash', 'access_token'
    ];

    public static function generateAccessToken(string $email, string $username, $password): string
    {
        return md5(sprintf('%s:%s:%s', $email, $username, (string) $password) . Str::random(8));
    }
}
