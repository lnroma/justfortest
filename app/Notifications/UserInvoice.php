<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserInvoice extends Notification
{
    use Queueable;

    const TYPE_ADD_IMAGE = 'add_image';
    const TYPE_ADD_BLOG = 'add_blog';
    const TYPE_COMMENT_BLOG = 'comment_blog';
    const TYPE_COMMENT_IMAGE = 'comment_image';
    const TYPE_USER_REQUEST = 'user_request';

    private $data = [];
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        //
        $this->data['type'] = $params['type'];
        $this->data['data'] = json_encode($params['data']);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'invoice_id' => $this->id,
            'type' => $this->data['type'],
            'data' => json_decode($this->data['data'], true),
        ];
    }
}
