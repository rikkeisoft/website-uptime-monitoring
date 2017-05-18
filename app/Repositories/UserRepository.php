<?php
namespace App\Repositories;

use Log;
use Illuminate\Support\Str;
use App\Models\User;

class UserRepository
{
    /**
     * Create a new  user
     * 
     * @param type $data
     * 
     * @return boolean
     */
    public function createUser($data = [])
    {        
        if (empty($data)) {
            return false;
        }
        
        try {
            $data = [
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'status' => 0,
                'access_token' => Str::random(60),
                'remember_token' => Str::random(60)
            ];
            
            $user = new User();
            $user->fill($data);
            $createdUser = $user->saveOrFail();
            // Trigger event Registered to send email
            return $createdUser;
        } catch (Exception $ex) {
             Log::error($ex->getMessage());
            return false;
        }        
//            User::create($data);
//            Mail::send('mail-template/mail-template-register', ['name' => $data['username'], 'email' => $data['email'], 'access_token' => $data['access_token']], function($message) {
//                $message->to(Input::get('email'))->subject('Register completed, confirm email verify!!');
//            });
//            return redirect('login');
//        } else {
//            return "Registration failed, please try again!";
//        }
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
