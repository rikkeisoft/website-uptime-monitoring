<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
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

    /**
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function register(RegistrationRequest $request)
    {
        $formData = $request->input();
        $result = $this->userRepository->createUser($formData);
        if ($result === false) {
            return 'Error'; // Redirect to error page
        }

        return redirect('/login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function activate(Request $request)
    {
        $token = $request->input('access_token', null);
        $result = $this->userRepository->activateUser($token);

        if ($result) {
            $request->session()->flash('alert-success', 'Authentication Successfully, please login!');
        } else {
            $request->session()->flash('alert-error', 'Account does not exist or not activate.Please try again');
        }
        return redirect('/login');
    }
}
