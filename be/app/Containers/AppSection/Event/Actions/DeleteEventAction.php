<?php

namespace App\Containers\AppSection\Event\Actions;

use App\Containers\AppSection\Event\Tasks\DeleteEventTask;
use App\Containers\AppSection\Event\UI\API\Requests\DeleteEventRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteEventAction extends ParentAction
{
    /**
     * @param DeleteEventRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteEventRequest $request): int
    {
        return app(DeleteEventTask::class)->run($request->id);
    }
}
