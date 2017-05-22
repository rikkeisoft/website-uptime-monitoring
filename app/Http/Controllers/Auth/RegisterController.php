<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class RegisterController extends Controller
{

    protected $userRepository;

    public function __construct()
    {
        $this->middleware('guest')->except('activate');
        $this->userRepository = new UserRepository();
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegistrationRequest $request)
    {
        $user= $request->input();
        $result = $this->userRepository->createUser($user);
        if ($result === false) {
            return 'Error'; // Redirect to error page
        }
        
            return redirect('/home');
    }

    public function activate(Request $request)
    {
        $token = $request->input('access_token');
        $result = $this->userRepository->activateUser($token);

        if ($result === false) {
            return redirect('/activate-error');
        }
            return redirect('/activate/successfully');
    }
}
