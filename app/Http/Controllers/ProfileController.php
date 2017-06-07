<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Auth;
use App\Http\Requests\Auth\ProFileRequest;
use Hash;

class ProfileController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     * @param $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
       return view('auth.user-profile');
    }


    /**
     * Changer password
     * @param ProFileRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ProFileRequest $request)
    {
        //Request password
        $data = $request->only('oldPassword','password');
        $id =  Auth::user()->id;
        if (Hash::check($data['oldPassword'], Auth::user()->password)) {
            $user = $this->userRepository->changePassword($data, $id);
        }
        if ($user) {
            $request->session()->flash('alert-success', 'Change Password Successfully');
            return redirect('/dashboard');
        }
        return redirect('/user-profile');
        $request->session()->flash('alert-error', 'Change Password Failed');
    }
}
