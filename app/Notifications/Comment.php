<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewComment extends Notification
{
    use Queueable;

    private $content_id;
    private $user_id;
    private $comment_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($content_id, $user_id, $comment_id)
    {
        $this->content_id = $content_id;
        $this->user_id = $user_id;
        $this->comment_id = $comment_id;
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
            'user' => $this->user_id,
            'comment' => $this->comment_id,
        ];
    }
}
