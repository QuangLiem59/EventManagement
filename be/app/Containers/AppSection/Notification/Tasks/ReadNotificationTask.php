<?php

namespace App\Containers\AppSection\Notification\Tasks;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class ReadNotificationTask extends ParentTask
{
    /**
     * @throws UpdateResourceFailedException
     */
    public function run($request)
    {
        try {
            $user = $request->user();
            if ($request->has('id')) {
                return $user->unreadNotifications()->where('id', $request->id)->update(['read_at' => now()]);
            }

            $user->unreadNotifications->markAsRead();
        } catch (Exception $e) {
            throw new UpdateResourceFailedException($e->getMessage());
        }
    }
}
