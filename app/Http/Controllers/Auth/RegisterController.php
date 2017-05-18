<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Mail;
use Illuminate\Support\Str;


class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        $token = User::generateAccessToken(
            input::get("email"),
            input::get("username"), 
            input::get('password')
        );
        Mail::send('mail', array('name' => input::get("username"), 'email' => input::get("email"), 'access_token' => $token), function($message) {
            $message->to(input::get("email"), 'Guest')->subject('Register completed, confirm email verify!!');
        });
        return User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'status' => 0,
                'access_token' => $token,
                'remember_token' => Str::random(60)
        ]);
    }

    public static function active()
    {
        $token = null;
        $token = input::get("access_token");
        $user = User::where('access_token', '=', $token)->first();
        if (!empty($user)) {
            $user = User::find($user['id']);
            $user->status = 1;
            $user->access_token = null;
            $user->save();
          return redirect('/active');
        } else {
            return redirect('/error');
        }
    }
}
