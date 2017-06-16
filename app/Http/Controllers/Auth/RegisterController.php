<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Repositories\UserRepository;

class RegisterController extends Controller
{
    /**
     * @var UserRepository
     */
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
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function register(RegistrationRequest $request)
    {
        $formData = $request->input();
        $result = $this->userRepository->createUser($formData);
        if ($result === false) {
            $request->session()->flash('alert-error', 'Registration failed.');
            return redirect('/register');
        }

        return redirect('/login');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function activate(Request $request)
    {
        $token = $request->input('access_token', null);
        $result = $this->userRepository->activateUser($token);

        if ($result) {
            $request->session()->flash('alert-success', 'Authentication is successfully.');
        } else {
            $request->session()->flash('alert-error', 'Account does not exists or is not activated yet.');
        }

        return redirect('/login');
    }
}
