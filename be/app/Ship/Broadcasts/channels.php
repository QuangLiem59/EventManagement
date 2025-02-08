<?php

use App\Containers\WrittenSection\Broadcast\Classes\Broadcast;
use App\Containers\AppSection\User\Models\User;

Broadcast::channel('users.{id}', function (?User $user, $userId) {
    return $user->id == $userId;
});