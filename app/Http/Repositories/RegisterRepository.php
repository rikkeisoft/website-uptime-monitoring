<?php
namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use Illuminate\Support\Str;
use App\Http\Requests\Auth;
use App\Http\Repositories;
use Illuminate\Support\Facades\Input;

class RegisterRepository
{

    public static function register($data)
    {
        if (!empty($data)) {
            User::create($data);
            Mail::send('mail-template/mail-template-register', ['name' => $data['username'], 'email' => $data['email'], 'access_token' => $data['access_token']], function($message) {
                $message->to(Input::get('email'))->subject('Register completed, confirm email verify!!');
            });
            return redirect('login');
        } else {
            return "Registration failed, please try again!";
        }
    }

    public static function activate($token)
    {
        $user = User::where('access_token', '=', $token)->first();
        if (!empty($user)) {
            $user = User::find($user['id']);
            $user->status = 1;
            $user->access_token = null;
            $user->save();
            return redirect('/activate/successfully');
        } else {
            return redirect('/activate-error');
        }
    }
}
