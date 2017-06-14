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
     * @var array
     */
    protected $data;

    /**
     * @param array
     */
    public function __construct(array $data)
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
            ->subject('Alert Service')
            ->view('mail-template.mail-template-send-alert', [
                'name' => $this->data['name'],
                'url' => $this->data['url'],
                'result' => $this->data['status'] == Constants::STATUS_FAILED ? 'Down' : 'Up',
            ]);
    }
}
