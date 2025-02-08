<?php

namespace App\Containers\AppSection\Notification\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Notification\Tasks\ReadNotificationTask;
use App\Containers\AppSection\Notification\UI\API\Requests\ReadNotificationRequest;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class ReadNotificationAction extends ParentAction
{
    /**
     * @param ReadNotificationRequest $request
     * @return void
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(ReadNotificationRequest $request)
    {
        app(ReadNotificationTask::class)->run($request);
    }
}
