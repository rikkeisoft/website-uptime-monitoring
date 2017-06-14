<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Mail;

class UserCreatedListener
{
    /**
     * Handle the event.
     *
     * @param UserCreated $event
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        $subject = 'Register completed, confirm email verify!!';

        Mail::send('mail-template/mail-template-register', [
            'name' => $user['username'],
            'access_token' => $user['access_token'],
        ], function ($message) use ($user, $subject) {
            $message->to($user['email'])->subject($subject);
        });
    }
}
