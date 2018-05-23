<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Message;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->subject = 'Новое сообщение на сайте pisec.online';
        $this->replyTo('director@pisec.online');
        $this->from('noreply@pisec.online');
        //$this->getHeaders()->addTextHeader('List-Unsubscribe', 'family_89@mail.ru');
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->withSwiftMessage(function ($message) {
            /** @var Swift_Message $message */
            $headers = $message->getHeaders();
            $headers->addTextHeader('List-Unsubscribe', 'family_89@mail.ru');
        });
        return $this->markdown('emails.unreadmessage');
    }
}
