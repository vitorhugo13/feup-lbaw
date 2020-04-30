<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContentDeleted extends Notification
{
    use Queueable;

    private $content;
    private $reason;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($content_id, $reason)
    {
        $this->content_id = $content_id;
        $this->reason = $reason;
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
            'content' => $this->content_id,
            'reason' => $this->reason,
        ];
    }
}
