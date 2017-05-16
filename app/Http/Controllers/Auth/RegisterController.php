<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use Mail;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register()
    {
        $rules = array(
            'username' => 'required|string|max:20|min:3',
            'email' => 'required|max:100|min:3',
            'password' => 'required|min:6|max:20',
        );
        // Generate access_token
        $token = User::generateAccessToken(
                input::get("email"),
                input::get("username"),
                input::get('password')
        );

        if (!Validator::make(input::all(), $rules)->fails()) {
            $user = new User();
            $user->email = input::get("email");
            $user->username = input::get("username");
            $user->password_hash = bcrypt(input::get("password"));
            $user->access_token = $token;
            $user->status = 0;
            $user->save();
            Mail::send('mail', array('name' => input::get("username"), 'email' => input::get("email"),'access_token'=>$token), function($message) {
                $message->to(input::get("email"), 'Guest')->subject('Register completed, confirm email verify!!');
            });

            return redirect('/home');
        } else {
            return "Registration failed!";
        }
    }
    public function active()
    {
        $token = null;
        $token = input::get("access_token");
        $user = User::where('access_token', '=', $token)->first();
        if (!empty($user)) {
            $user = User::find($user['id']);
            $user->status = 1;
            $user->save();
            echo "active success";
        }else {
           return "Account does not exist";    
        }
    }
}
