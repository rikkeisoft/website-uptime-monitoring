<?php

namespace App\Listeners;

use App\Events\SendMailGroup;
use App\Mail\SendMailGroupMail;
use Illuminate\Support\Facades\Mail;

class SendMailGroupListener
{
    /**
     * Handle the event.
     *
     * @param Registered $event
     */
    public function handle(SendMailGroup $event)
    {
        $data = $event->data;
        Mail::to($data['email'])->send(new SendMailGroupMail($event->data));
    }
}
