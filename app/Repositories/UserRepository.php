<?php

namespace App\Repositories;

use Log;
use Illuminate\Support\Str;
use App\Models\User;
use App\Events\UserCreated;

class UserRepository
{
    /**
     * Create a new  user.
     *
     * @param type  $data
     * @param mixed $user
     *
     * @return bool
     */
    public function createUser($user = [])
    {
        if (empty($user)) {
            return false;
        }

        try {
            $user = [
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => bcrypt($user['password']),
                'status' => 0,
                'access_token' => Str::random(60),
                'remember_token' => Str::random(60),
            ];
            $data = new User();
            $data->fill($user);
            $createdUser = $data->saveOrFail();
            // Get access_token, Event send mail
            event(new UserCreated($user));

            return $createdUser;
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());

            return false;
        }
    }

    public function activateUser($token)
    {
        if (!$token) {
            return false;
        }
        $user = User::where('access_token', $token)->first();
        if (empty($user)) {
            return false;
        }
        $user->status = 1;
        $user->access_token = null;
        $updated = $user->save();

        return $updated;
    }

    /**
     * @param array $data
     * @param $id
     *
     * @return bool
     */
    public function changePassword(array $data, $id)
    {
        if (empty($data)) {
            return false;
        }
        try {
            $user = User::find($id);
            $user->password = bcrypt($data['password']);
            $updatePass = $user->saveOrFail();

            return $updatePass;
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());

            return false;
        }
    }
}
