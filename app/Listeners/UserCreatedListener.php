<?php
namespace App\Listeners;

use App\Events\UserCreated;
use Mail;
use Illuminate\Support\Facades\Input;

class UserCreatedListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        Mail::send('mail-template/mail-template-register', ['name' => input::get('username'), 'access_token' => $user], function($message) {
            $message->to(input::get('email'))->subject('Register completed, confirm email verify!!');
        });
    }
}
