<?php

namespace App\Containers\AppSection\Notification\Events;

use App\Ship\Parents\Events\Event as ParentEvent;

class NotificationEvent extends ParentEvent
{
    public function __construct(
        public int $userId,
        public array $data
    ) {
    }
}
