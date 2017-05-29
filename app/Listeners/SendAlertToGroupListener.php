<?php

namespace App\Listeners;

use App\Events\SendAlertToGroup;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendAlertToGroupListener
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendAlertToGroup  $event
     * @return void
     */
    public function handle(SendAlertToGroup $event)
    {
        $data = $event->data;
        //send mail
        $subject = 'Send alert completed, please check mail!!';
        Mail::send('mail-template/mail-template-send-alert', [
            'name' => $data['name']
        ], function ($message) use ($data, $subject) {
            $message->to($data['email'])->subject($subject);
        });
    }
}
