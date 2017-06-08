<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Auth;
use App\Http\Requests\Auth\ProfileRequest;
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
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ProfileRequest $request)
    {
        //Request password
        $data = $request->only('current_password', 'password');
        $id = Auth::user()->id;

        // Check oldPassword
        if (Hash::check($request->input('current_password'), Auth::user()->password)) {
            $user = $this->userRepository->changePassword($data, $id);
            if ($user) {
                $request->session()->flash('alert-success', 'Change Password Successfully');
                return redirect('/user-profile');
            }
            $request->session()->flash('alert-error', 'Change Password Failed');
            return redirect('/user-profile');
        }
        $request->session()->flash('alert-error', 'Change Password Failed');
        return redirect('/user-profile');
    }
}
