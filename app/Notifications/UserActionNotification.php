<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class UserActionNotification extends Notification
{
    use Queueable;

    protected $action;
    protected $details;

    public function __construct($action, $details)
    {
        $this->action = $action;
        $this->details = $details;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'action' => $this->action,
            'details' => $this->details,
            'user_id' => $notifiable->id,
        ];
    }
}
