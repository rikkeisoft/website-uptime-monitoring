<?php

namespace App\Mail;

use App\Contracts\Constants;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailGroupMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $data;

    /**
     * @param User $user
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->onQueue('email');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Send alert completed, please check mail!!')
            ->view('mail-template.mail-template-send-alert', [
                'name' => $this->data['name'],
                'url' => $this->data['url'],
                'result'=> $this->data['status']== Constants::CHECK_FAILED?'Down':'Up'
            ]);
    }
}
