<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth;
use App\Http\Repositories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function activate()
    {
        $token = Input::get('access_token');
        return Repositories\RegisterRepository::activate($token);
    }

    public function register(Auth\RegisterRequest $request)
    {
        $data = [
            'username' => Input::get('username'),
            'email' => Input::get('email'),
            'password' => bcrypt(Input::get('password')),
            'status' => 0,
            'access_token' => Str::random(60),
            'remember_token' => Str::random(60)
        ];

        return Repositories\RegisterRepository::register($data);
    }
}
