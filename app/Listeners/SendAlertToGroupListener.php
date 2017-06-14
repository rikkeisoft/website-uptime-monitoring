<?php

namespace App\Listeners;

use App\Events\SendAlertToGroup;
use Mail;

class SendAlertToGroupListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param SendAlertToGroup $event
     */
    public function handle(SendAlertToGroup $event)
    {
        $data = $event->data;
        //send mail
        $subject = 'Alert Service';
        Mail::send('mail-template/mail-template-send-alert', [
            'name' => $data['name'],
            'url' => $data['url'],
            'result' => $data['result'],
            'date' => $data['date'],
        ], function ($message) use ($data, $subject) {
            $message->to($data['email'])->subject($subject);
        });
    }
}
