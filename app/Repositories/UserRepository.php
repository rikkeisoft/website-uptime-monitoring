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
     * @param type $data
     * 
     * @return boolean
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
                'remember_token' => Str::random(60)
            ];
            $data = new User();
            $data->fill($user);
            $createdUser = $data->saveOrFail();
            // Get access_token, Event send mail
            $getAccess =$data['access_token'];
            event(new UserCreated($getAccess));
            
            return $createdUser;
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return false;
        }
    }

    public function activateUser($token)
    {
        if (!$token) {
            return false;
        }
        $checkedUser = User::where('access_token', '=', $token)->first();
        if (empty($checkedUser)) {
            return false;
        }
        $user = User::find($checkedUser['id']);
        $user->status = 1;
        $user->access_token = null;
        $updated = $user->save();

        return $updated;
    }
}
