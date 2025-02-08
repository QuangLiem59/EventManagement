<?php

namespace App\Containers\AppSection\User\Events;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Events\Event as ParentEvent;

class CreateUserEvent extends ParentEvent
{
    public function __construct(
        public User $user
    ) {
    }
}
