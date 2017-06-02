<?php
namespace App\Repositories;

use Log;
use Illuminate\Support\Str;
use App\Models\User;
use App\Events\UserCreated;

class UserRepository
{

    /**
     * Create a new  user
     *
     * @param array $data
     *
     * @return boolean
     */
    public function createUser(array $data = [])
    {
        if (empty($data)) {
            return false;
        }
        try {
            $userData = [
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'status' => 0,
                'access_token' => Str::random(60),
                'remember_token' => Str::random(60)
            ];
            $user = new User();
            $user->fill($userData);
            $result = $user->saveOrFail();
            // Get access_token, Event send mail
            event(new UserCreated($userData));
            return $result;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return false;
        }
    }

    public function activateUser($token)
    {
        if (!$token) {
            return false;
        }
        $user = User::where([
            'access_token'=> $token,
            'status' => 0
            ])->first();
        if (empty($user)) {
            return false;
        }
        $user->status = 1;
        $user->access_token = null;
        $updated = $user->save();
        return $updated;
    }
}
