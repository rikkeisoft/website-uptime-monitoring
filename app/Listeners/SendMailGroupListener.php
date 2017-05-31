<?php

namespace App\Listeners;

use App\Events\AddChapter;
use App\Events\SendMailGroup;
use Illuminate\Support\Facades\Mail;
use App\Mail\AddChapterMail;

class SendMailGroupListener
{
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     */
    public function handle(SendMailGroup $event)
    {
        $data = $event->data;

        //Mail::to($emails)->send(new AddChapterMail($event->data));

        $subject = 'Send alert completed, please check mail!!';
        Mail::send('mail-template/mail-template-send-alert', [
            'name' => $data['name'],
            'url' => $data['url'],
            'result'=> $data['status']
        ], function ($message) use ($data, $subject) {
            $message->to($data['email'])->subject($subject);
        });
    }
}
