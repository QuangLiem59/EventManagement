<?php

namespace App\Containers\AppSection\User\Notifications;

use App\Ship\Parents\Notifications\Notification as ParentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class DefaultNotification extends ParentNotification implements ShouldQueue
{
    use Queueable;
    
    public function __construct(
        private string $title,
        private string $message
    )
    {

    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray()
    {
        return [
            'type' => 'default',
            'title' => $this->title,
            'message' => $this->message,
        ];
    }
}
