<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Block extends Notification
{
    use Queueable;

    private $end_date;
    private $reason;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($end_date, $reason)
    {
        $this->end_date = $end_date;
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
            'end_date' => $this->end_date,
            'reason' => $this->reason,
        ];
    }
}
