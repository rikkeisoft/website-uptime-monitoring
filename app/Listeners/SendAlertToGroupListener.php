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
        $subject = 'Website status alert';
        Mail::send('mail-template/mail-template-send-alert', [
            'name' => $data['name'],
            'url' => $data['url'],
            'result'=> $data['result']
        ], function ($message) use ($data, $subject) {
            $message->to($data['email'])->subject($subject);
        });
    }
}
